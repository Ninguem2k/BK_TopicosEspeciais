import { StyleSheet } from "react-native";

const COLORS = {
    primary: "#3555fc",
    secondary: "#ffcc00",
    white: "#FFF",
    black: "#000",
    gray: "#CCC",
};

const styles = StyleSheet.create({
    container: {
        flexDirection: "row",
        alignItems: "center",
        padding: 10,
        borderRadius: 10,
        marginBottom: 10,
    },
    avatar: {
        backgroundColor: COLORS.white,
        width: 80,
        height: 80,
        borderRadius: 45,
        marginRight: 10,
    },
    name: {
        fontSize: 16,
        fontWeight: "bold",
    },
    phone: {
        fontSize: 14,
        color: COLORS.gray,
        marginBottom: 5,
    },
    rating: {
        flexDirection: "row",
    },
});

export default styles;
