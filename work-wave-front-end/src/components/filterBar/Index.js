import { ScrollView, Pressable, Text, View } from "react-native";
import FilterCep from "../../components/filterCep/Index";
import Styles from "./Style";
import React from "react";

const FilterBar = ({ filters, activeFilter, setActiveFilter }) => {

    const handleDataFilter = (filter) => {
        setActiveFilter(filter);
    };

    return (
        <View style={Styles.container}>
            <FilterCep />
            <ScrollView horizontal showsHorizontalScrollIndicator={false}>
                {filters.map((filter, index) => {
                    const isActive = activeFilter === filter;
                    return (
                        <Pressable
                            key={index}
                            style={[
                                Styles.filterButton,
                                isActive && Styles.activeFilterButton,
                            ]}
                            onPress={() => handleDataFilter(filter)}>
                            <Text
                                style={[
                                    Styles.filterText,
                                    isActive && Styles.activeFilterText,
                                ]}>
                                {filter}
                            </Text>
                        </Pressable>
                    );
                })}
            </ScrollView>
        </View>
    );
};

export default FilterBar;
