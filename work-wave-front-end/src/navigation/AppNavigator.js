import React from "react";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import { Ionicons } from "@expo/vector-icons";

import { SackRoutes } from "./StackRoutes";
import { SearchScreen } from "../screens/search/SearchScreen";
import { MenuScreen } from "../screens/menu/MenuScreen";

const Tab = createBottomTabNavigator();

export function Routes() {
    return (
        <Tab.Navigator screenOptions={screenOptions}>
            <Tab.Screen
                name="HomeTab"
                component={SackRoutes}
                options={({ route }) => ({
                    tabBarIcon: ({ color, size, focused }) => (
                        <Ionicons
                            name={focused ? "home" : "home-outline"}
                            color={focused ? "#000" : color}
                            size={size}
                        />
                    ),
                    tabBarVisible: isTabVisible(route.name),
                })}
            />
            <Tab.Screen
                name="SearchTab"
                component={SearchScreen}
                options={({ route }) => ({
                    tabBarIcon: ({ color, size, focused }) => (
                        <Ionicons
                            name={focused ? "search" : "search-outline"}
                            color={focused ? "#000" : color}
                            size={size}
                        />
                    ),
                    tabBarVisible: isTabVisible(route.name),
                })}
            />
            <Tab.Screen
                name="MenuTab"
                component={MenuScreen}
                options={({ route }) => ({
                    tabBarIcon: ({ color, size, focused }) => (
                        <Ionicons
                            name={focused ? "menu" : "menu-outline"}
                            color={focused ? "#000" : color}
                            size={size}
                        />
                    ),
                    tabBarVisible: isTabVisible(route.name),
                })}
            />
        </Tab.Navigator>
    );
}

const screenOptions = {
    headerShown: false,
    tabBarHideOnKeyboard: true,
    tabBarShowLabel: false,
    tabBarActiveTintColor: "#121212",
    tabBarStyle: {
        backgroundColor: "#fff",
        borderTopWidth: 0,
    },
};

function isTabVisible(routeName) {
    const allowedScreens = ["HomeTab", "SearchTab", "MenuTab"];
    return allowedScreens.includes(routeName);
}