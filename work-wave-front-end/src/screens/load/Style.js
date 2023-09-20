import { StyleSheet } from "react-native";
const COLORS = {
    primary: "#3555fc",
    grey: "#333",
    secondary: "#0000FF",
    white: "#fff",
};

const Styles = StyleSheet.create({
    container: {
        flex: 1,
        alignItems: "center",
        justifyContent: "center",
        height: '100%',
    },
    h2: {
        fontSize: 24,
        color: COLORS.grey,
    },

});

export default Styles;
