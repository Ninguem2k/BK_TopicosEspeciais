import AsyncStorage from '@react-native-async-storage/async-storage';
import { NavigationContainer } from '@react-navigation/native';
import React, { useState, useEffect } from 'react';
import LoadingScreen from './src/screens/load/LoadingScreen';
import { Routes } from './src/navigation/AppNavigator';
import TermsModal from './src/components/terms/TermsModal';
import { AuthProvider } from "./src/services/AuthContext";

const App = () => {
    const [isLoading, setIsLoading] = useState(true);
    const [isModalVisible, setModalVisible] = useState(false);

    const checkAppStatus = async () => {
        try {
            const termsAccepted = await AsyncStorage.getItem('termsAccepted');

            if (!termsAccepted) {
                setModalVisible(true);
            }

        } catch (error) {
            console.log(error);
        } finally {
            setIsLoading(false);
        }
    };

    useEffect(() => {
        checkAppStatus();
    }, []);

    if (isLoading) {
        return <LoadingScreen />;
    }

    return (
        <NavigationContainer>
            <AuthProvider>
                <Routes />
            </AuthProvider>
            {isModalVisible && (
                <TermsModal isVisible={isModalVisible} onClose={() => setModalVisible(false)} />
            )}
        </NavigationContainer>
    );
};

export default App;
