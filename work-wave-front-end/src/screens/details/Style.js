import { StyleSheet } from "react-native";

const COLORS = {
    primary: "#3555fc",
    secondary: "#ffcc00",
    white: "#FFF",
    whiteInfo: "#c1c9c4",
    black: "#000",
    gray: "#CCC",
};

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: COLORS.gray,
    },
    slideshowContainer: {
        height: 210,
    },
    slideshowImage: {
        width: 380,
        height: 200,
        margin: 6,
        resizeMode: "cover",
    },
    productDetailsContainer: {
        padding: 20,
        minHeight: 300,
        backgroundColor: COLORS.white,
    },
    productTitle: {
        fontSize: 20,
        fontWeight: "bold",
    },
    productDescription: {
        fontSize: 15,
        marginBottom: 10,
    },
    priceContainer: {
        flexDirection: "row",
        alignItems: "center",
        marginBottom: 10,
    },
    currentPrice: {
        fontSize: 18,
        fontWeight: "bold",
        marginRight: 10,
    },
    previousPrice: {
        fontSize: 15,
        color: COLORS.gray,
        marginRight: 10,
        textDecorationLine: "line-through",
    },
    discountCard: {
        backgroundColor: COLORS.secondary,
        alignSelf: "flex-end",
        position: "absolute",
        paddingHorizontal: 5,
        paddingVertical: 5,
        borderRadius: 5,
        zIndex: 99,
        right: 15,
    },
    countSlideCard: {
        textAlign: "center",
        backgroundColor: COLORS.white,
        position: "absolute",
        borderRadius: 15,
        fontSize: 11,
        zIndex: 99,
        right: 15,
        width: 30,
        top: 180,
    },
    discountText: {
        fontSize: 16,
        color: COLORS.white,
        fontWeight: "bold",
    },
    buttonContract: {
        fontSize: 16,
        color: COLORS.white,
        fontWeight: "bold",
    },
    rating: {
        flexDirection: "row",
    },
    cardInf: {
        borderTopRightRadius: 0,
        backgroundColor: COLORS.white,
        justifyContent: "center",
        padding: 20,
        flexDirection: "row",
        justifyContent: "space-between",
    },
    medCard: {
        justifyContent: "space-between",
    },
    infoContainer: {
        flexDirection: "row",
        justifyContent: "center",
        shadowColor: COLORS.black,
        shadowOffset: {
            width: 0,
            height: 2,
        },
        shadowOpacity: 0.25,
        shadowRadius: 3.84,
        elevation: 5,
    },
    btnInfo: {
        flex: 1,
        backgroundColor: COLORS.white,
        paddingVertical: 15,
        paddingHorizontal: 40,
        justifyContent: "center",
        alignItems: "center",
    },
    btnText: {
        fontSize: 12,
        fontWeight: "bold",
        color: COLORS.black,
    },
    selectedInfo: {
        borderTopWidth: 3,
        borderTopColor: COLORS.primary,
    },
    cardComments: {
        justifyContent: "center",
        alignItems: "center",
        minHeight: 260,
        backgroundColor: COLORS.white,
    },
    cardInfoUser: {
        alignItems: "center",
        minHeight: 260,
        backgroundColor: COLORS.white,
    }
});

export default styles;
