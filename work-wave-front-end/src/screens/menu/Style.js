import { StyleSheet } from "react-native";

const COLORS = {
  primary: "#3555fc",
  white: "#FFF",
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: COLORS.white,
    paddingHorizontal: 10,
    paddingVertical: 32,
  },
  cardButtons: {
    flexDirection: "column",
    padding: 15,
  },
  button: {
    flexDirection: "row",
    alignItems: "center",
    paddingVertical: 16,
  },
  buttonText: {
    marginLeft: 8,
    fontSize: 18,
    fontWeight: "bold",
  },
  login: {
    flexDirection: "row-reverse",
    padding: 5,
  },
  buttonTextLogin: {
    width: 175,
    backgroundColor: COLORS.primary,
    color: COLORS.white,
    borderRadius: 5,
    padding: 10,
    marginBottom: 20,
    marginLeft: 10,
    textAlign: "center",
  },
});

export default styles;
