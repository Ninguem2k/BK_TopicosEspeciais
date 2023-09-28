import { StyleSheet } from "react-native";
const COLORS = {
    primary: "#3555fc",
    grey: "#ccc",
    secondary: "#0000FF",
    white: "#fff",
};

const Styles = StyleSheet.create({
    container: {
        flex: 1,
        alignItems: "center",
        justifyContent: "center",
        padding: 20,
    },
    title: {
        fontSize: 24,
        fontWeight: "bold",
        marginBottom: 20,
    },
    helpPassword: {
        fontSize: 18,
        color: COLORS.secondary,
        marginTop: 10,
        marginBottom: 20,
    },
    input: {
        borderWidth: 1,
        borderColor: COLORS.grey,
        borderRadius: 5,
        padding: 10,
        marginBottom: 20,
        width: "100%",
    },
    button: {
        backgroundColor: COLORS.primary,
        padding: 13,
        borderRadius: 5,
        width: "100%",
    },
    buttonText: {
        fontSize: 16,
        color: COLORS.white,
        fontWeight: "bold",
        textAlign: "center",
    },
});

export default Styles;
