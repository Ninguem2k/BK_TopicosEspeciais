import { useNavigation } from "@react-navigation/native";
import { TextInput, View } from "react-native";
import { Ionicons } from "@expo/vector-icons";
import React, { useState } from "react";
import Styles from "./Style";

const Search = () => {
    const [searchQuery, setSearchQuery] = useState("");
    const navigation = useNavigation();

    const handleSearch = () => {
        if (!searchQuery) return;
        navigation.navigate("SearchScreen", { input: searchQuery });
    };

    return (
        <View style={Styles.container}>
            <Ionicons
                name="search"
                size={24}
                color="black"
                onPress={handleSearch}
                style={Styles.icon}
            />
            <TextInput
                style={Styles.input}
                placeholder="O que está procurando?"
                value={searchQuery}
                onChangeText={setSearchQuery}
                onSubmitEditing={handleSearch}
            />
        </View>
    );
};

export default Search;
