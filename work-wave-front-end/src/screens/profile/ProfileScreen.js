import React, { useState, useEffect, useLayoutEffect, useContext } from "react";
import { useNavigation, useRoute } from "@react-navigation/native";
import { ScrollView, View, ActivityIndicator, TouchableOpacity } from "react-native";
import { Feather } from "@expo/vector-icons";

import ItemListEdit from "../../components/listItemCardEdit/Index";
import ItemList from "../../components/listItemCard/Index";
import CardUser from "../../components/cardUser/Index";
import api from "../../services/api";
import Styles from "./Style";
import { AuthContext } from "../../services/AuthContext";

export function ProfileScreen() {
    const route = useRoute();
    const navigation = useNavigation();
    const { user } = useContext(AuthContext);

    const [isLoading, setIsLoading] = useState(true);
    const [userData, setUserData] = useState([]);

    function isUserOwner() {
        if (user && user.id === route.params?.id) {
            return true;
        }
        return false;
    }

    useEffect(() => {
        const fetchUser = async () => {
            try {
                const response = await api.get(`/users/${route.params?.id}`);
                setUserData(response.data);
            } catch (error) {
                console.error("Error fetching User:", error);
            } finally {
                setIsLoading(false);
            }
        };

        fetchUser();
    }, [route.params?.id]);

    useLayoutEffect(() => {
        navigation.setOptions({
            title: userData?.name || "Perfil do Usuario",
        });
    }, [navigation, userData]);


    function handleItemEdit() {
        navigation.navigate("ConfigScreen");
    }

    const renderContent = () => {
        if (isLoading) {
            return <ActivityIndicator size="large" color="#000" />;
        }

        return (
            <>
                <View style={Styles.profile}>
                    {userData && <CardUser user={userData} />}
                    {isUserOwner() &&
                        <TouchableOpacity style={Styles.profileEdit} onPress={handleItemEdit}>
                            <Feather name="edit" size={24} />
                        </TouchableOpacity>}
                </View>
                <ScrollView>
                    {isUserOwner() ? (
                        <ItemListEdit items={userData.services} />
                    ) : (
                        <ItemList items={userData.services} />
                    )}
                </ScrollView>
            </>
        );
    };

    return <View style={Styles.container}>{renderContent()}</View>;
}

