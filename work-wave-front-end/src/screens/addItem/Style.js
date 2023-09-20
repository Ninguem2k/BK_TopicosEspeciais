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
    input: {
        borderRadius: 5,
        borderWidth: 1,
        marginBottom: 20,
        padding: 10,
    },
    inputPrice: {
        borderRadius: 5,
        borderWidth: 1,
        marginBottom: 20,
        marginLeft: 40,
        padding: 10,
        width: 160,
    },
    inputRC2: {
        flexDirection: "row-reverse",
    },
    title: {
        fontSize: 24,
        fontWeight: "bold",
        marginBottom: 20,
    },
    button: {
        backgroundColor: COLORS.primary,
        borderRadius: 5,
        padding: 13,
        width: "100%",
    },
    buttonText: {
        color: COLORS.white,
        fontWeight: "bold",
        textAlign: "center",
    },
    primaryButton: {
        backgroundColor: COLORS.primary,
    },
    secondaryButton: {
        backgroundColor: COLORS.secondary,
    },
});


export default Styles;
