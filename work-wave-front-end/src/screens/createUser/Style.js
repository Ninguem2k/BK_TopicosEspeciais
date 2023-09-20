import { StyleSheet } from "react-native";
const COLORS = {
    primary: "#3555fc",
    secondary: "#ccc",
    white: "#fff",
};

const Styles = StyleSheet.create({
    container: {
        flex: 1,
        padding: 20,
    },
    title: {
        fontSize: 24,
        fontWeight: "bold",
        marginBottom: 20,
    },
    input: {
        borderWidth: 1,
        borderRadius: 5,
        padding: 10,
        marginBottom: 20,
    },
    inputPrice: {
        width: 160,
        borderWidth: 1,
        borderRadius: 5,
        padding: 10,
        marginBottom: 20,
        marginLeft: 40,
    },
    inputRC2: {
        flexDirection: "row-reverse",
    },
    button: {
        backgroundColor: COLORS.primary,
        padding: 13,
        borderRadius: 5,
        width: "100%",
    },
    buttonText: {
        color: COLORS.white,
        fontWeight: "bold",
        textAlign: "center",
        fontSize: 16,
    },
    primaryButton: {
        backgroundColor: COLORS.primary,
    },
    secondaryButton: {
        backgroundColor: COLORS.secondary,
    },
});

export default Styles;
