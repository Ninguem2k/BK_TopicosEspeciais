import { StyleSheet } from "react-native";

const COLORS = {
    primary: "#3555fc",
    white: "#FFF",
    black: "#000",
};

const Styles = StyleSheet.create({
    container: {
        backgroundColor: COLORS.white,
        height: "100%",
    },
    greetingText: {
        marginTop: 25,
        marginLeft: 13,
        fontSize: 25,
        fontWeight: "bold",
        color: COLORS.black,
    },
});

export default Styles;