import React from "react";
import { Text, View, ScrollView, TouchableOpacity } from "react-native";
import { useNavigation } from "@react-navigation/native";

import Styles from "./Style";
import ItemCard from "../itemCard/Index";

const ItemList = ({ categoryName, categoryId, items }) => {
    const navigation = useNavigation();

    const handleNavigateCategory = () => {
        navigation.navigate("CategoriesScreen", { id: categoryId });
    };

    const handleNavigateItem = (itemId) => {
        navigation.navigate("DetailsScreen", { id: itemId });
    };

    return (
        <View style={Styles.container}>
            <View style={Styles.cardText}>
                <Text numberOfLines={2}
                    ellipsizeMode="tail" style={Styles.title}>{categoryName}</Text>
                <TouchableOpacity onPress={handleNavigateCategory}>
                    <Text style={Styles.viewMoreButtonText}>Ver Mais</Text>
                </TouchableOpacity>
            </View>

            <ScrollView horizontal showsHorizontalScrollIndicator={false}>
                {!!items.length &&
                    items.map((item) => (
                        <TouchableOpacity
                            key={item.id}
                            onPress={() => handleNavigateItem(item.id)}
                        >
                            <View style={Styles.card}>
                                <ItemCard item={item} />
                            </View>
                        </TouchableOpacity>
                    ))}
            </ScrollView>
        </View>
    );
};

const CardHorizontalScroll = ({ items }) => {
    return (
        <View style={Styles.itemList}>
            {!!items.length &&
                items.map((objeto) => (
                    <ItemList
                        key={objeto.id}
                        items={objeto.services}
                        categoryName={objeto.name}
                        categoryId={objeto.id}
                    />
                ))}
        </View>
    );
};

export default CardHorizontalScroll;
