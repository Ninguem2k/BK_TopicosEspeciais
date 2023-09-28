import { StyleSheet } from "react-native";

const Styles = StyleSheet.create({
    button: {
        borderRadius: 5,
        borderWidth: 1,
        marginBottom: 20,
        padding: 10,
        backgroundColor: "#3555fc",
        borderColor: "#3555fc",
    },

    buttonText: {
        textAlign: "center",
        color: 'white',
        fontSize: 16,
    },
    modalContainer: {
        flex: 1,
        paddingTop: 40,
        paddingHorizontal: 20,
    },
    modalHeader: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
        marginBottom: 20,
    },
    modalTitle: {
        fontSize: 20,
        fontWeight: 'bold',
    },
    closeButton: {
        color: 'red',
        fontSize: 16,
    },
    input: {
        borderWidth: 1,
        borderColor: 'gray',
        borderRadius: 5,
        padding: 10,
        marginBottom: 20,
    },
    cepItem: {
        marginBottom: 10,
    },
    title: {
        fontSize: 16,
        fontWeight: "bold",
        paddingBottom: 2,
    },
    description: {
        fontSize: 14,
        paddingBottom: 8,
    },
});

export default Styles;
