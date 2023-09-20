import React, { createContext, useState, useEffect } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';
import api from './api';

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(null);
    const navigation = useNavigation();

    const login = async (username, password) => {
        try {
            const config = {
                method: 'post',
                maxBodyLength: Infinity,
                url: '/sessions',
                headers: {
                    'Content-Type': 'application/json',
                },
                data: {
                    email: username,
                    password: password,
                },
            };

            const response = await api.request(config);

            const { token: accessToken, refreshToken, user: userData } = response.data;

            await AsyncStorage.setItem('accessToken', accessToken);
            await AsyncStorage.setItem('refreshToken', refreshToken);
            userData['token'] = accessToken;
            setUser(userData);
            setToken(accessToken);
            navigation.navigate('MenuScreen');
        } catch (error) {
            console.log(error);
        }
    };

    const loginWithToken = async () => {
        try {
            const oldRefreshToken = await AsyncStorage.getItem('refreshToken');

            if (oldRefreshToken) {
                const config = {
                    method: 'post',
                    maxBodyLength: Infinity,
                    url: '/refresh_token',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    data: {
                        refreshToken: oldRefreshToken,
                    },
                };

                const response = await api.request(config);
                const { token: accessToken, refreshToken, user: userData } = response.data;
                await AsyncStorage.setItem('accessToken', accessToken);
                await AsyncStorage.setItem('refreshToken', refreshToken);
                userData['token'] = accessToken;
                setUser(userData);
                setToken(accessToken);
            }
        } catch (error) {
            console.log(error);
        }
    };

    const logout = async () => {
        try {
            await AsyncStorage.removeItem('accessToken');
            await AsyncStorage.removeItem('refreshToken');
            setUser(null);
            setToken(null);
            navigation.navigate('HomeScreen');
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <AuthContext.Provider
            value={{
                loginWithToken,
                user,
                token,
                login,
                logout,
            }}
        >
            {children}
        </AuthContext.Provider>
    );
};
