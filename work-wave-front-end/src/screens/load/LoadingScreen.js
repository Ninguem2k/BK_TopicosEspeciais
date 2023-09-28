import React from 'react';
import Styles from "./Style";
import { View, Text } from 'react-native';
const LoadingScreen = () => {
    return (
        <View style={Styles.container}>
            <Text style={Styles.h2}>Loading...</Text>
        </View>
    );
};

export default LoadingScreen;
