import { View, Text, TouchableOpacity, Modal, TextInput, FlatList } from 'react-native';
import React, { useState, useEffect } from 'react';
import Styles from './Style';
import api from '../../services/api';

const DropdownCategory = ({ onData, categoryId }) => {
    const [modalVisible, setModalVisible] = useState(false);
    const [searchText, setSearchText] = useState('');
    const [categoryList, setCategoryList] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState('Categoria');

    useEffect(() => {
        async function fetchData() {
            try {
                const response = await api.get('/categories');
                setCategoryList(response.data);
                await setCurrentCategory();
            } catch (error) {
                console.error('Error fetching items:', error);
            }
        }
        fetchData();
    }, []);

    const setCurrentCategory = () => {
        const currentCategory = categoryList.find(category =>
            category.id.toLowerCase().includes(categoryId.toLowerCase())
        );

        if (currentCategory) {
            handleSelectCategory(currentCategory.name, currentCategory.id);
        }
    };

    const handleSearch = () => {
        const filteredCategories = categoryList.filter(category =>
            category.name.toLowerCase().includes(searchText.toLowerCase())
        );

        setCategoryList(filteredCategories);
    };

    const handleSelectCategory = (name, id) => {
        setSelectedCategory(name);
        onData(id);
        setModalVisible(false);
    };

    const renderCategoryItem = ({ item }) => {
        const { name, id, description } = item;
        return (
            <TouchableOpacity onPress={() => handleSelectCategory(name, id)}>
                <View style={Styles.categoryItem}>
                    <Text style={Styles.title}>{name}</Text>
                    <Text style={Styles.description}>{description}</Text>
                </View>
            </TouchableOpacity>
        );
    };

    return (
        <View style={Styles.container}>
            <TouchableOpacity style={Styles.button} onPress={() => setModalVisible(true)}>
                <Text style={Styles.buttonText}>{selectedCategory}</Text>
            </TouchableOpacity>

            <Modal visible={modalVisible} animationType="slide">
                <View style={Styles.modalContainer}>
                    <View style={Styles.modalHeader}>
                        <Text style={Styles.modalTitle}>Pesquisar Categoria</Text>
                        <TouchableOpacity onPress={() => setModalVisible(false)}>
                            <Text style={Styles.closeButton}>Fechar</Text>
                        </TouchableOpacity>
                    </View>

                    <TextInput
                        style={Styles.input}
                        placeholder="Digite uma Categoria"
                        value={searchText}
                        onChangeText={setSearchText}
                        onSubmitEditing={handleSearch}
                    />

                    <FlatList
                        data={categoryList}
                        renderItem={renderCategoryItem}
                        keyExtractor={item => item.id}
                    />
                </View>
            </Modal>
        </View>
    );
};

export default DropdownCategory;
