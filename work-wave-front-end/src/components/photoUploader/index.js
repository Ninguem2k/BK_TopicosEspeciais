import React, { useState } from "react";
import { Alert, Image, Text, TouchableOpacity, View, ActivityIndicator } from "react-native";
import * as DocumentPicker from "expo-document-picker";
import api from "../../services/api";

const PhotoUploader = ({ service_id, user }) => {
    const [selectedImage, setSelectedImage] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const uploadPhoto = async () => {
        if (!selectedImage) {
            return;
        }

        setIsLoading(true);

        const formData = new FormData();
        formData.append("images", {
            uri: selectedImage,
            name: "image.jpg",
            type: "image/jpeg",
        });

        const config = {
            method: "put",
            url: `/services/images/${service_id}`,
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

        setIsLoading(false);
    };

    const openDocumentPicker = async () => {
        const result = await DocumentPicker.getDocumentAsync({ type: "image/*" });

        if (result.type === "success") {
            setSelectedImage(result.uri);
            uploadPhoto();
        }
    };

    return (
        <View style={{ paddingBottom: 20 }}>
            <TouchableOpacity onPress={openDocumentPicker} style={styles.button}>
                <Text style={styles.buttonText}>Escolha uma Imagem</Text>
            </TouchableOpacity>
            {selectedImage && (
                <Image
                    source={{ uri: selectedImage }}
                    style={{ width: 100, height: 100, margin: 10 }}
                />
            )}
            {isLoading && <ActivityIndicator />}
        </View>
    );
};

const styles = {
    button: {
        backgroundColor: "#2196F3",
        padding: 10,
        borderRadius: 5,
    },
    buttonText: {
        color: "white",
        textAlign: "center",
    },
};

export default PhotoUploader;
