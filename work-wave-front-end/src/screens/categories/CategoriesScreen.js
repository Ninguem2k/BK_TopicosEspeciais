import { useRoute, useNavigation } from "@react-navigation/native";
import { useState, useEffect, useLayoutEffect } from "react";
import { ScrollView, ActivityIndicator } from "react-native";

import ItemList from "../../components/listItemCard/Index";
import api from "../../services/api";

export function CategoriesScreen() {
  const [isLoading, setIsLoading] = useState(true);
  const [items, setItems] = useState([]);
  const [categorie, setCategorie] = useState([]);
  const navigation = useNavigation();
  const route = useRoute();

  useEffect(() => {
    async function fetchItems() {
      try {
        const response = await api.get(`/categories/${route.params?.id}`);
        setCategorie(response.data.name);
        setItems(response.data.services);
      } catch (error) {
        console.error("Error fetching items:", error);
      } finally {
        setIsLoading(false);
      }
    }

    fetchItems();
  }, [route.params?.id]);

  useLayoutEffect(() => {
    navigation.setOptions({
      title: categorie,
    });
  }, [categorie]);


  return (
    <ScrollView>
      {isLoading ? (
        <ActivityIndicator size="large" color="#000" />
      ) : (
        <ItemList items={items} />
      )}
    </ScrollView>
  );
}
