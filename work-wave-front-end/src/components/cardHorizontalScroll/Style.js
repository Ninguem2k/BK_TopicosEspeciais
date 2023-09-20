import { StyleSheet } from "react-native";

const Styles = StyleSheet.create({
    container: {
        marginTop: 20,
        margin: 10,
    },

    card: {
        flex: 1,
        width: 170,
        height: 130,
        marginLeft: 5,
        marginEnd: 25,
    },

    cardText: {
        flexDirection: "row",
        justifyContent: "space-between",
    },
    title: {
        maxWidth: 180,
        fontSize: 20,
        fontWeight: "bold",
        marginLeft: 5,
        marginBottom: 5,
    },
    viewMoreButtonText: {
        fontSize: 15,
        color: "#3555fc",
        fontWeight: "bold",
        alignSelf: "flex-end",
    },
});

export default Styles;
