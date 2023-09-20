import { Text, View, ScrollView, TouchableOpacity, Image } from "react-native";
import { useNavigation } from "@react-navigation/native";
import Styles from "./Style";
import React from "react";


const CardCategory = ({ categorys }) => {
    const navigation = useNavigation();

    function handleNavigateCategory(imput) {
        navigation.navigate("CategoriesScreen", { id: imput });
    }

    return (
        <View style={Styles.container}>
            <ScrollView
                horizontal={true}
                showsHorizontalScrollIndicator={false}>
                {!!categorys.length &&
                    categorys.map(category => (
                        <TouchableOpacity
                            onPress={() =>
                                handleNavigateCategory(category.id)
                            }
                            key={category.id}>
                            <View style={Styles.cardContent}>
                                <View style={Styles.card}>
                                    <Image
                                        source={{ uri: category.icon_url }}
                                        style={Styles.cover}
                                    />
                                </View>

                                <Text
                                    numberOfLines={2}
                                    ellipsizeMode="tail"
                                    style={Styles.title}>
                                    {category.name}
                                </Text>
                            </View>
                        </TouchableOpacity>
                    ))}
            </ScrollView>
        </View>
    );
};

export default CardCategory;