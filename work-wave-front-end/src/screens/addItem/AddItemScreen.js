import React, { useState, useLayoutEffect, useContext } from "react";
import { View, TextInput, TouchableOpacity, Text, Alert } from "react-native";
import { useNavigation, useRoute } from "@react-navigation/native";

import DropdownCategory from "../../components/DropdownCategory/Index";
import { AuthContext } from "../../services/AuthContext";
import PhotoUploader from "../../components/photoUploader";
import api from "../../services/api";
import Styles from "./Style";

export function AddItemScreen() {
    const navigation = useNavigation();
    const { user } = useContext(AuthContext);
    const route = useRoute();
    const { id } = route.params ?? "";

    const [name, setName] = useState("");
    const [description, setDescription] = useState("");
    const [price, setPrice] = useState("");
    const [discount, setDiscount] = useState("");
    const [category, setCategory] = useState("");

    useLayoutEffect(() => {
        if (id) {
            navigation.setOptions({
                title: "Atualizar Serviço",
            });
            fetchItem();
        } else {
            navigation.setOptions({
                title: "Cadastrar Serviço",
            });
        }
    }, [navigation]);

    const handleCategoryData = (data) => {
        setCategory(data);
    };


    const fetchItem = async () => {
        try {
            const response = await api.get(`/services/${id}`);
            const { name, description, price, discount, category_id } = response.data;
            setName(name);
            setDescription(description);
            setPrice(price.toString());
            setDiscount(discount.toString());
            setCategory(category_id);
        } catch (error) {
            console.error("Error fetching service:", error);
        }
    };

    const insertItemData = async () => {
        try {
            const data = {
                name,
                description,
                observation: "",
                price,
                order: 0,
                discount,
                category_id: category,
                user_id: user.id,
            };

            const config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "/services",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${user.token}`,
                },
                data,
            };

            const response = await api.request(config);

            if (response.status === 201) {
                Alert.alert("Serviço adicionado com sucesso!");
                clearForm();
            }
        } catch (error) {
            console.log(error);
            Alert.alert("Erro ao adicionar serviço!");
        }
    };

    const updateItemData = async () => {
        try {
            const data = {
                id,
                name,
                description,
                observation: "",
                price,
                order: 0,
                discount,
                category_id: category,
                user_id: user.id,
            };

            const config = {
                method: "put",
                maxBodyLength: Infinity,
                url: "/services",
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${user.token}`,
                },
                data,
            };

            const response = await api.request(config);

            if (response.status === 204) {
                Alert.alert("Serviço atualizado com sucesso!");
                clearForm();
                navigation.navigate("ProfileScreen", { id: user.id });
            }
        } catch (error) {
            console.log(error);
            Alert.alert("Erro ao atualizar serviço!");
        }
    };

    function handleSubmit() {
        if (id) {
            updateItemData();
        } else {
            insertItemData();
        }
    };

    const clearForm = () => {
        setName("");
        setDescription("");
        setPrice("");
        setDiscount("");
    };

    return (
        <View style={{ padding: 16 }}>
            {id && (
                <PhotoUploader
                    style={{ padding: 40 }}
                    service_id={id}
                    user={user}
                />
            )}

            <TextInput
                style={Styles.input}
                placeholder="Nome do Serviço"
                value={name}
                onChangeText={(text) => setName(text)}
            />

            <DropdownCategory onData={handleCategoryData} categoryId={category} />

            <TextInput
                multiline={true}
                numberOfLines={4}
                style={Styles.input}
                placeholder="Descrição do produto"
                value={description}
                onChangeText={(text) => setDescription(text)}
            />

            <View style={Styles.inputRC2}>
                <TextInput
                    style={Styles.inputPrice}
                    placeholder="Desconto (%)"
                    keyboardType="numeric"
                    value={discount}
                    onChangeText={(text) => setDiscount(text)}
                />
                <TextInput
                    style={Styles.inputPrice}
                    placeholder="Preço (R$)"
                    keyboardType="numeric"
                    value={price}
                    onChangeText={(text) => setPrice(text)}
                />
            </View>

            <TouchableOpacity style={Styles.button} onPress={handleSubmit}>
                <Text style={Styles.buttonText}>Salvar</Text>
            </TouchableOpacity>
        </View>
    );
};


