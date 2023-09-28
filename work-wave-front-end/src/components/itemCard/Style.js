import { StyleSheet } from "react-native";

const styles = StyleSheet.create({
    container: {
        flex: 1,
        width: "100%",
        height: "100%",
        aspectRatio: 1.5,
    },
    cover: {
        width: "100%",
        height: "100%",
        borderRadius: 20,
        resizeMode: "cover",
    },
    info: {
        position: "absolute",
        bottom: 14,
        left: 10,
        zIndex: 999,
    },
    title: {
        fontSize: 16,
        fontWeight: "bold",
        color: "#fff",
    },
    description: {
        flexDirection: "row",
        alignItems: "center",
    },
    gradient: {
        left: 0,
        right: 0,
        zIndex: 1,
        bottom: 0,
        height: "55%",
        position: "absolute",
        borderBottomLeftRadius: 20,
        borderBottomRightRadius: 20,
        backgroundColor: "transparent",
    },
    touchable: {
        flex: 1,
    },
    price: {
        fontSize: 14,
        color: "#fff",
    },
});

export default styles;
