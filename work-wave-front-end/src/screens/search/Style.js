import { StyleSheet } from "react-native";

const COLORS = {
    primary: "#3555fc",
    secondary: "#ffcc00",
    white: "#FFF",
    black: "#000",
    gray: "#CCC",
};

const Styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: COLORS.white,
    },
    msgNotFoundItems: {
        textAlignVertical: "center",
        textAlign: "center",
        fontSize: 13,
        color: COLORS.gray,
    },
    containerSearch: {
        paddingTop: 20,
    },
});

export default Styles;