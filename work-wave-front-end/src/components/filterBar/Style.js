import { StyleSheet } from "react-native";

const Styles = StyleSheet.create({
    container: {
        marginTop: 5,
        alignSelf: "center",
        flexDirection: "row",
        alignItems: "center",
        paddingHorizontal: 10,
        width: "93%",
        height: 40,
        justifyContent: "center",
        zIndex: 99,
        backgroundColor: "#FFF",
        marginBottom: 10,
    },
    filterButton: {
        paddingHorizontal: 16,
        paddingVertical: 8,
        borderRadius: 20,
        borderWidth: 1,
        borderColor: "#ccc",
        marginHorizontal: 4,
    },
    filterText: {
        fontWeight: "bold",
        color: "#000",
    },
    activeFilterButton: {
        backgroundColor: "#3555fc",
        borderColor: "#3555fc",
    },
    activeFilterText: {
        color: "#FFF",
    },
});

export default Styles;
