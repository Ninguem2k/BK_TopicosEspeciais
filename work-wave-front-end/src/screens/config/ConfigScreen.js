import React, { useState, useLayoutEffect, useEffect, useContext } from "react";
import { Alert, Text, View, TextInput, TouchableOpacity, Image } from "react-native";
import { useNavigation } from "@react-navigation/native";
import api from "../../services/api";
import Styles from "./Style";
import * as ImagePicker from "expo-image-picker";
import Constants from "expo-constants";
import { AuthContext } from "../../services/AuthContext";

export function ConfigScreen() {
    const { user } = useContext(AuthContext);
    const navigation = useNavigation();
    const [avatar, setAvatar] = useState(null);
    const [id, setId] = useState("");
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [phone, setPhone] = useState("");
    const [cep, setCep] = useState("");

    useLayoutEffect(() => {
        navigation.setOptions({
            title: "Atualizar perfil",
        });
    }, [navigation]);

    useEffect(() => {
        const fetchUser = async () => {
            try {
                const response = await api.get(`/users/${user.id}`);
                setAvatar({ uri: response.data.avatar_url || null });
                setId(response.data.id);
                setName(response.data.name);
                setEmail(response.data.email);
                setPhone(response.data.phone);
                setCep(response.data.cep);
            } catch (error) {
                console.error("Error fetching User:", error);
            }
        };

        fetchUser();
    }, [user.id]);

    const requestCameraRollPermission = async () => {
        if (Constants.platform.ios) {
            const { status } = await ImagePicker.requestMediaLibraryPermissionsAsync();

            if (status !== "granted") {
                alert("Nós precisamos dessa permissão.");
                return false;
            }
        }
        return true;
    };

    const imagePickerCall = async () => {
        const permissionGranted = await requestCameraRollPermission();

        if (!permissionGranted) {
            return;
        }

        const result = await ImagePicker.launchImageLibraryAsync({
            mediaTypes: ImagePicker.MediaTypeOptions.Images,
            allowsEditing: true,
            aspect: [1, 1],
            quality: 1,
        });

        if (result.canceled) {
            return;
        }



        setAvatar(result.assets[0]);
    };

    const uploadImage = async () => {
        if (!avatar) {
            return;
        }

        const formData = new FormData();
        formData.append("image", {
            uri: avatar.uri,
            name: "image.jpg",
            type: "image/jpeg",
        });

        const config = {
            method: "put",
            url: `/users/avatar`,
            headers: {
                Authorization: `Bearer ${user.token}`,
                "Content-Type": "multipart/form-data",
            },
            data: formData,
        };

        try {
            const response = await api.request(config);
            if (response.status === 204) {
                Alert.alert("Imagem enviada com sucesso!");
            } else {
                Alert.alert("Falha ao enviar a imagem. Tente novamente.");
            }
        } catch (error) {
            console.log(error);
            Alert.alert("Ocorreu um erro. Tente novamente mais tarde.");
        }
    };

    const handleSubmit = async () => {
        await uploadImage();
        const data = {
            id,
            name,
            email,
            phone,
            cep,
        };

        const config = {
            method: "put",
            maxBodyLength: Infinity,
            url: "/users",
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + user.token,
            },
            data: data,
        };

        try {
            const response = await api.request(config);

            if (response.status === 200) {
                await uploadImage();
                navigation.navigate("MenuScreen");
            }
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <View style={{ padding: 16 }}>
            <TouchableOpacity onPress={imagePickerCall}>
                <View style={Styles.containerAvatar}>
                    <Image
                        source={{
                            uri: avatar
                                ? avatar.uri
                                : "https://st3.depositphotos.com/9998432/13335/v/450/depositphotos_133352102-stock-illustration-default-placeholder-profile-icon.jpg",
                        }}
                        style={Styles.avatar}
                    />
                </View>
            </TouchableOpacity>

            <TextInput
                style={Styles.input}
                placeholder="Nome"
                value={name}
                onChangeText={setName}
            />
            <TextInput
                style={Styles.input}
                placeholder="Email"
                value={email}
                onChangeText={setEmail}
            />
            <View style={Styles.inputRC2}>
                <TextInput
                    style={Styles.inputPrice}
                    placeholder="CEP"
                    keyboardType="numeric"
                    value={cep}
                    onChangeText={setCep}
                />
                <TextInput
                    style={Styles.inputPrice}
                    placeholder="Telefone"
                    keyboardType="numeric"
                    value={phone}
                    onChangeText={setPhone}
                />
            </View>

            <TouchableOpacity style={Styles.button} onPress={handleSubmit}>
                <Text style={Styles.buttonText}>Salvar</Text>
            </TouchableOpacity>
        </View>
    );
}
