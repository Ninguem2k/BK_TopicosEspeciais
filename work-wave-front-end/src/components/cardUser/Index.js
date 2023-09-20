import React from "react";
import { Feather } from "@expo/vector-icons";
import { Text, View, Image } from "react-native";
import Styles from "./Style";

const RatingIcons = ({ totalStars, filledColor, emptyColor }) => {
    return (
        <View style={Styles.rating}>
            {[...Array(totalStars)].map((_, i) => (
                <Feather
                    key={i}
                    name="star"
                    size={22}
                    color={i < Math.floor(totalStars) ? filledColor : emptyColor}
                />
            ))}
        </View>
    );
};

const CardUser = ({ user: { avatar_url, name, phone } }) => {
    const imageUrl = avatar_url || "https://st3.depositphotos.com/9998432/13335/v/450/depositphotos_133352102-stock-illustration-default-placeholder-profile-icon.jpg";

    return (
        <View style={Styles.container}>
            <Image source={{ uri: imageUrl }} style={Styles.avatar} />
            <View>
                <Text style={Styles.name}>{name}</Text>
                <Text style={Styles.phone}>{phone}</Text>
                <RatingIcons totalStars={5} filledColor="#FFD700" emptyColor="#CCC" />
            </View>
        </View>
    );
};


export default CardUser;
