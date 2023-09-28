import { View, Text, TouchableOpacity, Modal, TextInput, FlatList } from 'react-native';
import React, { useState } from 'react';
import Styles from "./Style";

const FilterCep = () => {
  const [modalVisible, setModalVisible] = useState(false);
  const [searchText, setSearchText] = useState('');
  const [cepList, setCepList] = useState([]);


  const handleSearch = () => {

    const cepData = [
      { cep: '38640-000', address: 'Riachinho' },
      { cep: '38660-000', address: 'Arinos' },
    ];

    setCepList(cepData);
  };

  const renderCepItem = ({ item }) => (
    <View style={Styles.cepItem}>
      <Text>{item.cep}</Text>
      <Text>{item.address}</Text>
    </View>
  );

  return (
    <View style={Styles.container}>
      <TouchableOpacity style={Styles.button} onPress={() => setModalVisible(true)}>
        <Text style={Styles.buttonText}>3864000</Text>
      </TouchableOpacity>

      <Modal visible={modalVisible} animationType="slide">
        <View style={Styles.modalContainer}>
          <View style={Styles.modalHeader}>
            <Text style={Styles.modalTitle}>Pesquisar CEP</Text>
            <TouchableOpacity onPress={() => setModalVisible(false)}>
              <Text style={Styles.closeButton}>Fechar</Text>
            </TouchableOpacity>
          </View>

          <TextInput
            style={Styles.input}
            placeholder="Digite um CEP"
            value={searchText}
            onChangeText={setSearchText}
            onSubmitEditing={handleSearch}
          />

          <FlatList
            data={cepList}
            renderItem={renderCepItem}
            keyExtractor={(item) => item.cep}
          />
        </View>
      </Modal>
    </View>
  );
};
export default FilterCep;
