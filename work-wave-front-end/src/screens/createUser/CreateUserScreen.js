import React, { useState, useLayoutEffect } from "react";
import { Text, View, TextInput, TouchableOpacity } from "react-native";

import { useNavigation } from "@react-navigation/native";
import api from "../../services/api";
import Styles from "./Style";

export function CreateUserScreen() {
    const navigation = useNavigation();
    const [name, setName] = useState("");
    const [email, setemail] = useState("");
    const [phone, setphone] = useState("");
    const [cep, setcep] = useState("");
    const [password, setpassword] = useState("");

    const handleSubmit = () => {

        const data = {
            name: name,
            email: email,
            phone: phone,
            cep: cep,
            password: password,
        };

        const fetchData = async () => {
            try {
                let config = {
                    method: 'post',
                    maxBodyLength: Infinity,
                    url: '/users',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    data: data
                };

                api.request(config)
                    .then((response) => {
                        console.log(response.status);
                        navigation.navigate("LoginScreen");
                    })
                    .catch((error) => {
                        console.log(error);
                    })

            } catch (error) {
                console.error(error);
            }
        }

        fetchData();
    };

    useLayoutEffect(() => {
        navigation.setOptions({
            title: "Cadastrar Usuario",
        });
    }, [navigation]);

    return (
        <View style={{ padding: 16 }}>
            <TextInput
                style={Styles.input}
                placeholder="Nome"
                value={name}
                onChangeText={text => setName(text)}
            />
            <TextInput
                style={Styles.input}
                placeholder="Email"
                value={email}
                onChangeText={text => setemail(text)}
            />
            <View style={Styles.inputRC2}>
                <TextInput
                    style={Styles.inputPrice}
                    placeholder="CEP"
                    keyboardType="numeric"
                    value={cep}
                    onChangeText={text => setcep(text)}
                />
                <TextInput
                    style={Styles.inputPrice}
                    placeholder="Telefone"
                    keyboardType="numeric"
                    value={phone}
                    onChangeText={text => setphone(text)}
                />
            </View>

            <TextInput
                style={Styles.input}
                placeholder="Senha"
                value={password}
                onChangeText={text => setpassword(text)}
            />
            <TouchableOpacity style={Styles.button} onPress={handleSubmit}>
                <Text style={Styles.buttonText}>Salvar</Text>
            </TouchableOpacity>
        </View>
    );
}
