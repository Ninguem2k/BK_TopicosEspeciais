import { StyleSheet } from "react-native";

const Styles = StyleSheet.create({
    container: {
        flex: 1,
        marginTop: 10,
        marginHorizontal: 10,
        justifyContent: "center",
    },

    card: {
        width: 60,
        height: 55,
        marginLeft: 5,
        marginRight: 5,
        backgroundColor: "#FFF",
        borderColor: "#CCC",
        borderWidth: 1,
        borderRadius: 5,
        justifyContent: "center",
        alignItems: "center",
    },
    cardContent: {
        justifyContent: "center",
        alignItems: "center",
    },

    title: {
        fontSize: 12,
        fontWeight: "bold",
        maxWidth: 90,
        textAlign: "center",
    },

    cover: {
        width: 50,
        height: 45,
        justifyContent: "center",
        alignItems: "center",
    }
});

export default Styles;
