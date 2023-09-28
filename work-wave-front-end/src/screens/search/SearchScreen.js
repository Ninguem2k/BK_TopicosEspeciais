import React, { useState, useEffect } from "react";
import { View, ScrollView, Text, ActivityIndicator } from "react-native";
import { useRoute } from "@react-navigation/native";

import api from "../../services/api";
import Styles from "./Style";

import ItemList from "../../components/listItemCard/Index";
import FilterBar from "../../components/filterBar/Index";
import Search from "../../components/search/Index";

const filterOptions = {
    Novidades: "recentDate",
    Tradicionais: "oldDate",
    "Menor valor": "lowerPrice",
    "Maior valor": "higherPrice",
};

export function SearchScreen() {
    const route = useRoute();

    const [items, setItems] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [activeFilter, setActiveFilter] = useState("Todos");

    const filters = [
        "Todos",
        "Novidades",
        "Menor valor",
        "Tradicionais",
        "Maior valor",
    ];

    function realFilters() {
        return filterOptions[activeFilter] || null;
    }

    useEffect(() => {
        const seatchParams = `${route.params?.input || 'a'}/?cep=38640-000&order=${realFilters()}`;
        async function fetchItems() {
            try {
                const response = await api.get("/services/search/" + seatchParams);
                setItems(response.data);
            } catch (error) {
                console.error("Error fetching items:", error);
            } finally {
                setIsLoading(false);
            }
        }

        fetchItems();
    }, [route.params?.input, activeFilter]);

    return (
        <View style={Styles.container}>
            <View style={Styles.containerSearch}>
                <Search />
            </View>

            {isLoading ? (
                <ActivityIndicator size="large" />
            ) : items.length === 0 ? (
                <Text style={Styles.msgNotFoundItems}>Faça uma Busca.</Text>
            ) : (
                <View style={Styles.container}>
                    <FilterBar
                        filters={filters}
                        activeFilter={activeFilter}
                        setActiveFilter={setActiveFilter}
                    />
                    <ScrollView>
                        <ItemList items={items} />
                    </ScrollView>
                </View>
            )}
        </View>
    );
}
