import React, { useContext } from "react";
import { View, Image, Text, TouchableOpacity, Alert } from "react-native";
import { useNavigation } from "@react-navigation/native";
import { Feather } from "@expo/vector-icons";

import Styles from "./Style";
import api from "../../services/api";
import { AuthContext } from "../../services/AuthContext";

const ItemCardEdit = ({ item }) => {
    const { id, images, name, price, discount } = item;
    const { user } = useContext(AuthContext);
    const navigation = useNavigation();

    const handleNavigateItem = () => {
        navigation.navigate("DetailsScreen", { id });
    };

    const handleItemEdit = () => {
        navigation.navigate("AddItemScreen", { id });
    };

    const handleItemDelete = (id) => {
        Alert.alert(
            "Confirmar exclusão",
            "Tem certeza de que deseja excluir este serviço?",
            [
                { text: "Cancelar", style: "cancel" },
                { text: "Excluir", style: "destructive", onPress: () => deleteItem(id) },
            ]
        );
    };

    const deleteItem = (id) => {
        const config = {
            method: "delete",
            maxBodyLength: Infinity,
            url: `/services/${id}`,
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${user.token}`,
            },
        };

        api
            .request(config)
            .then((response) => {
                console.log(response.status);
                Alert.alert("Serviço deletado com sucesso!");
            })
            .catch((error) => {
                console.log(error);
            });
    };

    const coverSelect = images ? images[0].url : "https://cdn1.staticpanvel.com.br/produtos/15/produto-sem-imagem.jpg";

    const renderRatingStars = () => {
        const stars = Array.from({ length: 5 }).map((_, i) => (
            <Feather
                key={i}
                name="star"
                size={14}
                color={i < Math.floor(5) ? "#FFD700" : "#CCC"}
            />
        ));
        return <View style={Styles.rating}>{stars}</View>;
    };

    return (
        <TouchableOpacity onPress={handleNavigateItem}>
            <View style={Styles.container}>
                <Image source={{ uri: coverSelect }} style={Styles.image} />
                <View style={Styles.infoContainer}>
                    <Text style={Styles.name}>{name}</Text>
                    {renderRatingStars()}
                    <Text style={Styles.price}>R${price}</Text>
                    <Text style={Styles.discount}>R${price - discount}</Text>
                </View>
                <View style={Styles.actions}>
                    <TouchableOpacity style={Styles.action} onPress={() => handleItemDelete(id)}>
                        <Feather name="trash" size={24} />
                    </TouchableOpacity>
                    <TouchableOpacity style={Styles.action} onPress={handleItemEdit}>
                        <Feather name="edit" size={24} />
                    </TouchableOpacity>
                </View>
            </View>
        </TouchableOpacity>
    );
};

const ItemListEdit = ({ items }) => {
    return (
        <View style={Styles.itemList}>
            {items.map((item) => (
                <ItemCardEdit key={item.id} item={item} />
            ))}
        </View>
    );
};

export default ItemListEdit;
