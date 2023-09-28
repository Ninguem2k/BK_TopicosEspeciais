import React, { useState, useEffect, useContext } from "react";
import { View, Text, TouchableOpacity } from "react-native";
import { useNavigation } from "@react-navigation/native";
import { Feather } from "@expo/vector-icons";

import Styles from "./Style";
import { AuthContext } from "../../services/AuthContext";
import CardUser from "../../components/cardUser/Index";

export const MenuScreen = () => {
  const navigation = useNavigation();
  const [userData, setUserData] = useState(null);
  const { user, logout } = useContext(AuthContext);

  useEffect(() => {
    setUserData(user);
  }, [user]);

  const handleLogout = async () => {
    if (!user) {
      return
    }

    logout();
  };

  const handleSettings = () => {
    navigation.navigate("ConfigScreen");
  };

  const handleFavorite = () => { };

  const handleProfile = () => {
    navigation.navigate("ProfileScreen", { id: user.id });
  };

  const handleLogin = () => {
    navigation.navigate("LoginScreen");
  };

  const handleRegister = () => {
    navigation.navigate("CreateUserScreen");
  };

  const handleAddItem = () => {
    navigation.navigate("AddItemScreen");
  };

  return (
    <View style={Styles.container}>
      {!userData ? (
        <View style={Styles.login}>
          <TouchableOpacity onPress={handleRegister}>
            <Text style={Styles.buttonTextLogin}>Cadastrar</Text>
          </TouchableOpacity>
          <TouchableOpacity onPress={handleLogin}>
            <Text style={Styles.buttonTextLogin}>Logar</Text>
          </TouchableOpacity>
        </View>
      ) : (
        <TouchableOpacity onPress={handleProfile}>
          <CardUser user={userData} />
        </TouchableOpacity>
      )}
      <View style={Styles.cardButtons}>
        <TouchableOpacity onPress={handleFavorite} style={Styles.button}>
          <Feather name="heart" size={24} color="#000" />
          <Text style={Styles.buttonText}>Favoritos</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={handleSettings} style={Styles.button}>
          <Feather name="settings" size={24} color="#000" />
          <Text style={Styles.buttonText}>Configuração</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={handleAddItem} style={Styles.button}>
          <Feather name="book" size={24} color="#000" />
          <Text style={Styles.buttonText}>Cadastrar um serviço</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={handleLogout} style={Styles.button}>
          <Feather name="log-out" size={24} color="#000" />
          <Text style={Styles.buttonText}>Sair</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
};
