import React from "react";
import { View, Image, Text, TouchableOpacity } from "react-native";
import { useNavigation } from "@react-navigation/native";
import { Feather } from "@expo/vector-icons";

import Styles from "./Style";
import WhatsappButton from "../../components/whatsappButton/Index";

const ItemCard = ({ item }) => {
    const { id, images, name, price, discount } = item;
    const navigation = useNavigation();

    const handleNavigateItem = (itemId) => {
        navigation.navigate("DetailsScreen", { id: itemId });
    };

    const coverSelect = images ? images[0].url : "https://cdn1.staticpanvel.com.br/produtos/15/produto-sem-imagem.jpg";

    return (
        <TouchableOpacity onPress={() => handleNavigateItem(id)}>
            <View style={Styles.container}>
                <Image source={{ uri: coverSelect }} style={Styles.image} />
                <View style={Styles.infoContainer}>
                    <Text style={Styles.name}>{name}</Text>
                    <View style={Styles.rating}>
                        {[...Array(5)].map((_, i) => (
                            <Feather
                                key={i}
                                name="star"
                                size={14}
                                color={i < Math.floor(5) ? "#FFD700" : "#CCC"}
                            />
                        ))}
                    </View>
                    {discount >= 0 && (
                        <Text style={Styles.price}>R${price}</Text>
                    )}
                    <Text style={Styles.discount}>R${price - discount}</Text>
                </View>
                <WhatsappButton />
            </View>
        </TouchableOpacity>
    );
};

const ItemList = ({ items }) => {
    return (
        <View style={Styles.itemList}>
            {!!items.length &&
                items.map((item) => (
                    < ItemCard key={item.id} item={item} />
                ))}
        </View>
    );
};

export default ItemList;
