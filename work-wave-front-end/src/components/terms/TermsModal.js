import React, { useState, useEffect } from 'react';
import { View, Text, TextInput, Button, Modal, StyleSheet, ScrollView } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';

const TermsModal = ({ isVisible, onClose }) => {
    const navigation = useNavigation();
    const [cep, setCep] = useState('');
    const [assCep, setAssCep] = useState(false);
    const [assTerms, setAssTerms] = useState(false);

    useEffect(() => {
        const fetchUser = async () => {
            try {
                if (assCep && assTerms) {
                    navigation.navigate('HomeScreen');
                }
            } catch (error) {
                console.error('Error saving terms or cep:', error);
            }
        };

        fetchUser();
    }, [assCep, assTerms]);

    const handleAcceptTerms = async () => {
        // if (cep === '') {
        //     return;
        // }

        try {
            await AsyncStorage.setItem('cep', cep);
            await AsyncStorage.setItem('termsAccepted', 'true');
            setAssCep(true);
            setAssTerms(true);
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <Modal visible={isVisible} onRequestClose={onClose}>
            <View style={styles.container}>
                <Text style={styles.inputLabel}>Informe seu CEP:</Text>
                <TextInput style={styles.input} value={cep} onChangeText={setCep} />

                <Text style={styles.heading}>Termos e Condições</Text>
                <ScrollView>

                    <Text style={styles.description}>
                        Termos e Condições de Uso do Aplicativo Marketplace

                        Bem-vindo ao nosso aplicativo de marketplace! Ao utilizar este aplicativo, você concorda em cumprir e ficar vinculado aos seguintes termos e condições de uso. Leia atentamente as informações a seguir:

                        1 Aceitação dos Termos
                        1.1. Ao acessar e utilizar este aplicativo, você reconhece ter lido, compreendido e concordado com estes termos e condições de uso. Se você não concordar com estes termos, não utilize o aplicativo.
                        1.2. Reservamo-nos o direito de modificar, atualizar ou substituir estes termos a qualquer momento, a nosso critério exclusivo. Recomendamos que você revise periodicamente os termos para se manter informado sobre quaisquer alterações. O uso contínuo do aplicativo após a publicação de quaisquer alterações constitui aceitação dessas modificações.

                        2 Uso do Aplicativo
                        2.1. O aplicativo é fornecido para facilitar a interação entre vendedores e compradores. Você pode utilizar o aplicativo para explorar, comprar e vender produtos e serviços oferecidos pelos usuários registrados no marketplace.
                        2.2. Ao utilizar o aplicativo, você declara ser legalmente capaz de celebrar contratos e concorda em cumprir todas as leis e regulamentações aplicáveis durante o uso do aplicativo.

                        3 Registo e Conta do Usuário
                        3.1. Para utilizar todas as funcionalidades do aplicativo, você deverá criar uma conta de usuário. As informações fornecidas durante o processo de registro devem ser precisas, completas e atualizadas.
                        3.2. Você é responsável por manter a confidencialidade de suas credenciais de login e é totalmente responsável por todas as atividades que ocorram em sua conta.
                        3.3. Reservamo-nos o direito de encerrar, suspender ou restringir o acesso à sua conta, a nosso critério exclusivo, se considerarmos que você violou estes termos ou se houver suspeita de atividades fraudulentas ou prejudiciais.

                        4 Responsabilidades do Usuário
                        4.1. Ao utilizar o aplicativo, você concorda em cumprir com todas as leis e regulamentações aplicáveis.
                        4.2. Você é o único responsável pelo conteúdo que postar ou transmitir por meio do aplicativo, incluindo informações, produtos, imagens e mensagens. Você declara e garante que possui todos os direitos necessários sobre o conteúdo que fornecer e que ele não viola direitos de terceiros.
                        4.3. Você concorda em não utilizar o aplicativo para qualquer finalidade ilegal, fraudulenta, difamatória, ofensiva, discriminatória, ou de qualquer forma prejudicial para outros usuários.

                        5 Propriedade Intelectual
                        5.1. O aplicativo e todo o seu conteúdo, incluindo logotipos, textos, imagens, vídeos, gráficos e software, são protegidos por leis de propriedade intelectual e pertencem ao proprietário do aplicativo ou a terceiros licenciadores.
                        5.2. Você concorda em não copiar, distribuir, modificar, criar obras derivadas, exibir publicamente, realizar engenharia reversa ou decompilar qualquer parte do aplicativo sem o consentimento prévio por escrito do proprietário.

                        6 Limitação de Responsabilidade
                        6.1. O aplicativo é fornecido "no estado em que se encontra", sem garantias de qualquer tipo, expressas ou implícitas. Não nos responsabilizamos por quaisquer danos diretos, indiretos, incidentais, especiais ou consequenciais decorrentes do uso ou incapacidade de uso do aplicativo.
                        6.2. Não garantimos a precisão, integridade ou atualidade das informações fornecidas no aplicativo. Você utiliza as informações por sua própria conta e risco.

                        7 Disposições Gerais
                        7.1. Estes termos constituem o acordo completo entre você e nós, substituindo todos os acordos anteriores.
                        7.2. Caso qualquer disposição destes termos seja considerada inválida ou inexequível, as demais disposições permanecerão em pleno vigor e efeito.
                        7.3. A falha em exercer ou aplicar qualquer direito ou disposição destes termos não constituirá uma renúncia a tal direito ou disposição.
                        7.4. Estes termos serão regidos e interpretados de acordo com as leis do país em que o aplicativo está sediado.

                        Se você tiver alguma dúvida sobre estes termos e condições de uso, entre em contato conosco através dos canais de suporte disponibilizados no aplicativo
                    </Text>
                </ScrollView>
                <Button title="Aceitar" onPress={handleAcceptTerms} />
            </View>
        </Modal>
    );
};

const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        paddingHorizontal: 20,
    },
    heading: {
        fontSize: 20,
        fontWeight: 'bold',
        marginBottom: 10,
    },
    description: {
        marginBottom: 20,
        textAlign: 'center',
    },
    inputLabel: {
        fontSize: 16,
        marginBottom: 10,
    },
    input: {
        width: '100%',
        height: 40,
        borderWidth: 1,
        borderColor: '#ccc',
        marginBottom: 20,
        paddingHorizontal: 10,
    },
});

export default TermsModal;
