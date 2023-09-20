import {
    View,
    TextInput,
    Text,
    TouchableOpacity,
} from "react-native";
import React, { useState, useLayoutEffect, useContext } from "react";
import { useNavigation } from "@react-navigation/native";

import Styles from "./Style";
import { AuthContext } from '../../services/AuthContext';

export function LoginScreen() {
    const navigation = useNavigation();
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const { login } = useContext(AuthContext);

    useLayoutEffect(() => {
        navigation.setOptions({
            title: "Logar",
        });
    }, [navigation]);

    const handleLogin = () => {
        login(email, password);
    };

    return (
        <View style={Styles.container}>
            <Text style={Styles.title}>Bem vindo de volta!</Text>
            <TextInput
                style={Styles.input}
                placeholder="E-mail"
                value={email}
                onChangeText={text => setEmail(text)}
                autoCapitalize="none"
                keyboardType="email-address"
            />
            <TextInput
                style={Styles.input}
                placeholder="Senha"
                value={password}
                onChangeText={text => setPassword(text)}
                secureTextEntry={true}
            />
            <TouchableOpacity style={Styles.button} onPress={handleLogin}>
                <Text style={Styles.buttonText}>Entrar</Text>
            </TouchableOpacity>
            <Text style={Styles.helpPassword}>Esqueceu a senha?</Text>
        </View>
    );
}


