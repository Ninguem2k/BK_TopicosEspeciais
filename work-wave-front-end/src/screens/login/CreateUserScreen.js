import Styles from "./Style";

import React, { useState, useLayoutEffect } from "react";
import { Text, View, TextInput, TouchableOpacity } from "react-native";
import { useNavigation } from "@react-navigation/native";

export function CreateUserScreen() {
    const navigation = useNavigation();
    const [name, setName] = useState("");
    const [email, setemail] = useState("");
    const [phone, setphone] = useState("");
    const [cep, setcep] = useState("");
    const [password, setpassword] = useState("");

    const handleSubmit = () => {};

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
                    value={phone}
                    onChangeText={text => setphone(text)}
                />
                <TextInput
                    style={Styles.inputPrice}
                    placeholder="Telefone"
                    keyboardType="numeric"
                    value={cep}
                    onChangeText={text => setcep(text)}
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
