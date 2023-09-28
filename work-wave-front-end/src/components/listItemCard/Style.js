import { StyleSheet } from "react-native";

const styles = StyleSheet.create({
    container: {
        flexDirection: "row",
        alignItems: "center",
        justifyContent: "space-between",
        borderBottomWidth: 1,
        borderColor: "#ccc",
        paddingBottom: 5,
        paddingTop: 5,
        marginVertical: 2,
    },
    image: {
        width: 100,
        height: 100,
    },
    title: {
        maxWidth: 100,
        marginLeft: 12,
    },
    infoContainer: {
        flex: 1,
        marginLeft: 12,
    },
    name: {
        fontWeight: "bold",
        fontSize: 16,
        marginBottom: 8,
    },
    price: {
        fontSize: 14,
        marginBottom: 4,
        textDecorationLine: "line-through",
        color: "gray",
    },
    discount: {
        fontSize: 18,
        marginBottom: 4,
    },
    itemList: {
        paddingHorizontal: 16,
    },
    rating: {
        flexDirection: "row",
    },
});

export default styles;
