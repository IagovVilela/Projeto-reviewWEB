import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { 
  BuildingOfficeIcon, 
  PhotoIcon,
  EnvelopeIcon,
  StarIcon,
  CheckIcon
} from '@heroicons/react/24/outline';

const CompanyForm = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    logo: null,
    backgroundImage: null,
    positiveThreshold: 4,
    googleUrl: ''
  });
  const [loading, setLoading] = useState(false);
  const [success, setSuccess] = useState(false);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleFileChange = (e) => {
    const { name, files } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: files[0]
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);

    // Simular envio
    setTimeout(() => {
      setLoading(false);
      setSuccess(true);
      setTimeout(() => {
        navigate('/');
      }, 2000);
    }, 2000);
  };

  if (success) {
    return (
      <div className="max-w-2xl mx-auto">
        <div className="card text-center">
          <div className="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <CheckIcon className="h-6 w-6 text-green-600" />
          </div>
          <h3 className="mt-4 text-lg font-medium text-gray-900">Empresa criada com sucesso!</h3>
          <p className="mt-2 text-sm text-gray-500">
            A página de avaliação foi gerada automaticamente e está pronta para uso.
          </p>
          <div className="mt-6">
            <button
              onClick={() => navigate('/')}
              className="btn-primary"
            >
              Voltar ao Dashboard
            </button>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="max-w-2xl mx-auto">
      <div className="mb-8">
        <h2 className="text-2xl font-bold text-gray-900">Nova Empresa</h2>
        <p className="mt-1 text-sm text-gray-500">
          Crie uma nova empresa e gere automaticamente sua página de avaliação
        </p>
      </div>

      <form onSubmit={handleSubmit} className="space-y-6">
        <div className="card">
          <h3 className="text-lg font-medium text-gray-900 mb-4">Informações Básicas</h3>
          
          {/* Nome da Empresa */}
          <div className="mb-4">
            <label htmlFor="name" className="block text-sm font-medium text-gray-700 mb-2">
              Nome da Empresa *
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <BuildingOfficeIcon className="h-5 w-5 text-gray-400" />
              </div>
              <input
                type="text"
                name="name"
                id="name"
                required
                value={formData.name}
                onChange={handleInputChange}
                className="input-field pl-10"
                placeholder="Ex: Restaurante XYZ"
              />
            </div>
          </div>

          {/* Email */}
          <div className="mb-4">
            <label htmlFor="email" className="block text-sm font-medium text-gray-700 mb-2">
              Email para Notificações *
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <EnvelopeIcon className="h-5 w-5 text-gray-400" />
              </div>
              <input
                type="email"
                name="email"
                id="email"
                required
                value={formData.email}
                onChange={handleInputChange}
                className="input-field pl-10"
                placeholder="contato@empresa.com"
              />
            </div>
          </div>

          {/* URL do Google */}
          <div className="mb-4">
            <label htmlFor="googleUrl" className="block text-sm font-medium text-gray-700 mb-2">
              URL do Google Maps/Reviews *
            </label>
            <input
              type="url"
              name="googleUrl"
              id="googleUrl"
              required
              value={formData.googleUrl}
              onChange={handleInputChange}
              className="input-field"
              placeholder="https://maps.google.com/..."
            />
          </div>
        </div>

        <div className="card">
          <h3 className="text-lg font-medium text-gray-900 mb-4">Personalização</h3>
          
          {/* Upload Logo */}
          <div className="mb-4">
            <label htmlFor="logo" className="block text-sm font-medium text-gray-700 mb-2">
              Logo da Empresa
            </label>
            <div className="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div className="space-y-1 text-center">
                <PhotoIcon className="mx-auto h-12 w-12 text-gray-400" />
                <div className="flex text-sm text-gray-600">
                  <label htmlFor="logo" className="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                    <span>Upload do logo</span>
                    <input
                      id="logo"
                      name="logo"
                      type="file"
                      accept="image/*"
                      onChange={handleFileChange}
                      className="sr-only"
                    />
                  </label>
                  <p className="pl-1">ou arraste e solte</p>
                </div>
                <p className="text-xs text-gray-500">PNG, JPG até 2MB</p>
              </div>
            </div>
          </div>

          {/* Upload Imagem de Fundo */}
          <div className="mb-4">
            <label htmlFor="backgroundImage" className="block text-sm font-medium text-gray-700 mb-2">
              Imagem de Fundo
            </label>
            <div className="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
              <div className="space-y-1 text-center">
                <PhotoIcon className="mx-auto h-12 w-12 text-gray-400" />
                <div className="flex text-sm text-gray-600">
                  <label htmlFor="backgroundImage" className="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                    <span>Upload da imagem</span>
                    <input
                      id="backgroundImage"
                      name="backgroundImage"
                      type="file"
                      accept="image/*"
                      onChange={handleFileChange}
                      className="sr-only"
                    />
                  </label>
                  <p className="pl-1">ou arraste e solte</p>
                </div>
                <p className="text-xs text-gray-500">PNG, JPG até 5MB</p>
              </div>
            </div>
          </div>
        </div>

        <div className="card">
          <h3 className="text-lg font-medium text-gray-900 mb-4">Configurações de Avaliação</h3>
          
          {/* Threshold de Avaliação Positiva */}
          <div className="mb-4">
            <label htmlFor="positiveThreshold" className="block text-sm font-medium text-gray-700 mb-2">
              Limite para Avaliação Positiva
            </label>
            <div className="flex items-center space-x-4">
              <input
                type="range"
                name="positiveThreshold"
                id="positiveThreshold"
                min="1"
                max="5"
                step="1"
                value={formData.positiveThreshold}
                onChange={handleInputChange}
                className="flex-1"
              />
              <div className="flex items-center space-x-1">
                <span className="text-sm font-medium text-gray-700">
                  {formData.positiveThreshold}+
                </span>
                <StarIcon className="h-5 w-5 text-yellow-400" fill="currentColor" />
              </div>
            </div>
            <p className="mt-1 text-sm text-gray-500">
              Avaliações com {formData.positiveThreshold} estrelas ou mais serão consideradas positivas
            </p>
          </div>
        </div>

        <div className="flex justify-end space-x-3">
          <button
            type="button"
            onClick={() => navigate('/')}
            className="btn-secondary"
          >
            Cancelar
          </button>
          <button
            type="submit"
            disabled={loading}
            className="btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {loading ? 'Criando...' : 'Criar Empresa'}
          </button>
        </div>
      </form>
    </div>
  );
};

export default CompanyForm;





