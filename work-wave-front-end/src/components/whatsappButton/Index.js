import Styles from "./Style";
import React from "react";
import { TouchableOpacity, Text } from "react-native";

import { Linking } from "react-native";

const sendWhatsappMessage = (phoneNumber, title) => {
    try {
        const message =
            "Olá, Gostaria de saber mais sobre "+ title +", Eu encontrei ele no WorkWave!";
        Linking.openURL(`whatsapp://send?phone=${phoneNumber}&text=${message}`);
    } catch (error) {
        console.log(error);
    }
};

const WhatsappButton = ({phoneNumber, name}) => {
    return (
        <TouchableOpacity style={Styles.button} onPress={() => sendWhatsappMessage(phoneNumber, name)}>
            <Text style={Styles.buttonText}>Contratar</Text>
        </TouchableOpacity>
    );
};

export default WhatsappButton;
