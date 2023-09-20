import React, { useState, useEffect, useLayoutEffect } from "react";
import {
    Text,
    View,
    Image,
    ScrollView,
    Share,
    Pressable,
    TouchableOpacity,
    ActivityIndicator,
} from "react-native";
import { useNavigation, useRoute } from "@react-navigation/native";
import { Feather } from "@expo/vector-icons";

import Styles from "./Style";
import api from "../../services/api";
import CardUser from "../../components/cardUser/Index";
import WhatsappButton from "../../components/whatsappButton/Index";

export const DetailsScreen = () => {
    const [currentImage, setCurrentImage] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const [item, setItem] = useState(null);
    const [displayedComponentInfo, setDisplayedComponentInfo] = useState("description");
    const navigation = useNavigation();
    const route = useRoute();

    useEffect(() => {
        const fetchItem = async () => {
            try {
                const response = await api.get(`/services/${route.params?.id}`);
                setItem(response.data);
            } catch (error) {
                console.error("Error fetching item:", error);
            } finally {
                setIsLoading(false);
            }
        };

        fetchItem();
    }, [route.params?.id]);

    useLayoutEffect(() => {
        navigation.setOptions({
            title: item?.name || "Detatalhes",
            headerRight: () => (
                <Pressable onPress={shareRecipe}>
                    <Feather name="share-2" color="#121212" size={24} />
                </Pressable>
            ),
        });
    }, [navigation, item]);

    const handleImageScroll = event => {
        const slide = Math.ceil(
            event.nativeEvent.contentOffset.x / event.nativeEvent.layoutMeasurement.width
        );
        if (slide !== currentImage) {
            setCurrentImage(slide);
        }
    };

    const shareRecipe = async () => {
        try {
            await Share.share({
                message: "Olá!",
            });
        } catch (error) {
            console.log(error);
        }
    };

    const calculateDiscountedPrice = () => {
        return item.discount !== 0 ? (item.discount / 100) * item.price + item.price : item.price;
    };

    const handleNavigateProfile = id => {
        navigation.navigate("ProfileScreen", { id });
    };

    const showComponentInfo = component => {
        setDisplayedComponentInfo(component);
    };

    const renderDescription = () => {
        return (
            <ScrollView style={Styles.productDetailsContainer}>
                <Text style={Styles.productTitle}>{item?.name}</Text>
                <Text style={Styles.productDescription}>{item?.description}</Text>
            </ScrollView>
        );
    };

    const renderComments = () => {
        return <View style={Styles.cardComments}><Text >Ainda não há comentários neste serviço.</Text></View >;
    };

    const renderUser = () => {
        return (
            <View style={Styles.cardInfoUser}>
                <TouchableOpacity onPress={() => handleNavigateProfile(item?.user?.id)}>
                    <CardUser user={item?.user} />
                </TouchableOpacity>
            </View>
        );
    };

    const imagesToRender = item?.images || [
        {
            id: "5a31a89c-48dd-4872-9763-5f63252e3849",
            name: "20cb97e7-265a-4acf-9f0f-e7055daf86b7.png",
            url: "https://cdn1.staticpanvel.com.br/produtos/15/produto-sem-imagem.jpg",
        },
    ];

    return (
        <ScrollView style={Styles.container}>
            {isLoading ? (
                <ActivityIndicator size="large" color="#000" />
            ) : (
                <>
                    {item?.discount > 0 && (
                        <View style={Styles.discountCard}>
                            <Text style={Styles.discountText}>
                                - {item.discount}%
                                <Feather name="arrow-down" size={18} color="#FFF" />
                            </Text>
                        </View>
                    )}
                    <View style={Styles.slideshowContainer}>
                        <ScrollView horizontal pagingEnabled onScroll={handleImageScroll}>
                            {imagesToRender.map((image, index) => (
                                <Image key={index} source={{ uri: image.url }} style={Styles.slideshowImage} />
                            ))}
                        </ScrollView>
                    </View>
                    <Text style={Styles.countSlideCard}>
                        {currentImage + 1}/{imagesToRender.length}
                    </Text>
                    <View style={Styles.medCard}>
                        <View style={Styles.cardInf}>
                            <View>
                                <View style={Styles.rating}>
                                    {[...Array(5)].map((_, i) => (
                                        <Feather
                                            key={i}
                                            name="star"
                                            size={22}
                                            color={i < Math.floor(5) ? "#FFD700" : "#CCC"}
                                        />
                                    ))}
                                </View>
                                <View style={Styles.priceContainer}>
                                    <Text style={Styles.currentPrice}>R${calculateDiscountedPrice()}</Text>
                                    {item?.discount > 0 && <Text style={Styles.previousPrice}>R${item.price}</Text>}
                                </View>
                            </View>
                            <View>
                                <WhatsappButton
                                    style={Styles.buttonContract}
                                    phoneNumber={item?.user?.phone}
                                    name={item?.name}
                                />
                            </View>
                        </View>
                    </View>

                    <View style={Styles.infoContainer}>
                        <View style={displayedComponentInfo === "description" && Styles.selectedInfo}>
                            <TouchableOpacity style={Styles.btnInfo} onPress={() => showComponentInfo("description")}>
                                <Text style={Styles.btnText}>Descrição</Text>
                            </TouchableOpacity>
                        </View>
                        <View style={displayedComponentInfo === "comments" && Styles.selectedInfo}>
                            <TouchableOpacity style={Styles.btnInfo} onPress={() => showComponentInfo("comments")}>
                                <Text style={Styles.btnText}>Comentários</Text>
                            </TouchableOpacity>
                        </View>
                        <View style={displayedComponentInfo === "owner" && Styles.selectedInfo}>
                            <TouchableOpacity style={Styles.btnInfo} onPress={() => showComponentInfo("owner")}>
                                <Text style={Styles.btnText}>Fornecedor</Text>
                            </TouchableOpacity>
                        </View>
                    </View >

                    <View >
                        {displayedComponentInfo === "description" && renderDescription()}
                        {displayedComponentInfo === "comments" && renderComments()}
                        {displayedComponentInfo === "owner" && renderUser()}
                    </View>
                </>
            )}
        </ScrollView >
    );
};

