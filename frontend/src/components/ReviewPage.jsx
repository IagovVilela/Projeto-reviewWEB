import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { 
  StarIcon, 
  PhoneIcon,
  ChatBubbleLeftRightIcon,
  CheckCircleIcon,
  ExclamationTriangleIcon
} from '@heroicons/react/24/outline';

const ReviewPage = () => {
  const { token } = useParams();
  const [company, setCompany] = useState(null);
  const [rating, setRating] = useState(0);
  const [whatsapp, setWhatsapp] = useState('');
  const [comment, setComment] = useState('');
  const [feedback, setFeedback] = useState('');
  const [step, setStep] = useState('rating'); // rating, whatsapp, feedback, success
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Simular carregamento da empresa
    setTimeout(() => {
      setCompany({
        id: 1,
        name: 'Restaurante XYZ',
        logo: 'https://via.placeholder.com/150',
        backgroundImage: 'https://via.placeholder.com/800x400',
        email: 'contato@restaurantexyz.com',
        positiveThreshold: 4,
        googleUrl: 'https://maps.google.com/...'
      });
      setLoading(false);
    }, 1000);
  }, [token]);

  const handleRatingSubmit = () => {
    if (rating > 0) {
      setStep('whatsapp');
    }
  };

  const handleWhatsappSubmit = () => {
    if (whatsapp.trim()) {
      if (rating >= company.positiveThreshold) {
        setStep('success');
        // Redirecionar para Google após 3 segundos
        setTimeout(() => {
          window.open(company.googleUrl, '_blank');
        }, 3000);
      } else {
        setStep('feedback');
      }
    }
  };

  const handleFeedbackSubmit = () => {
    if (feedback.trim()) {
      setStep('success');
    }
  };

  const formatWhatsapp = (value) => {
    // Remove tudo que não é número
    const numbers = value.replace(/\D/g, '');
    
    // Formata como (XX) XXXXX-XXXX
    if (numbers.length <= 11) {
      return numbers.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    }
    return value;
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  if (!company) {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center">
        <div className="text-center">
          <ExclamationTriangleIcon className="mx-auto h-12 w-12 text-red-500" />
          <h3 className="mt-2 text-sm font-medium text-gray-900">Página não encontrada</h3>
          <p className="mt-1 text-sm text-gray-500">
            A página de avaliação solicitada não existe ou foi removida.
          </p>
        </div>
      </div>
    );
  }

  return (
    <div 
      className="min-h-screen bg-cover bg-center bg-no-repeat"
      style={{ backgroundImage: `url(${company.backgroundImage})` }}
    >
      <div className="min-h-screen bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div className="max-w-md w-full">
          <div className="bg-white rounded-2xl shadow-2xl p-8">
            {/* Header */}
            <div className="text-center mb-8">
              <img 
                src={company.logo} 
                alt={company.name}
                className="mx-auto h-16 w-16 rounded-full mb-4"
              />
              <h1 className="text-2xl font-bold text-gray-900 mb-2">
                {company.name}
              </h1>
              <p className="text-gray-600">
                Sua opinião é muito importante para nós!
              </p>
            </div>

            {/* Rating Step */}
            {step === 'rating' && (
              <div className="space-y-6">
                <div className="text-center">
                  <h2 className="text-lg font-medium text-gray-900 mb-4">
                    Como foi sua experiência?
                  </h2>
                  <div className="flex justify-center space-x-2">
                    {[1, 2, 3, 4, 5].map((star) => (
                      <button
                        key={star}
                        onClick={() => setRating(star)}
                        className="focus:outline-none"
                      >
                        <StarIcon
                          className={`h-12 w-12 transition-colors ${
                            star <= rating ? 'text-yellow-400' : 'text-gray-300'
                          }`}
                          fill={star <= rating ? 'currentColor' : 'none'}
                        />
                      </button>
                    ))}
                  </div>
                  <p className="mt-2 text-sm text-gray-500">
                    {rating > 0 && `${rating} estrela${rating > 1 ? 's' : ''}`}
                  </p>
                </div>

                <button
                  onClick={handleRatingSubmit}
                  disabled={rating === 0}
                  className="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  Continuar
                </button>
              </div>
            )}

            {/* WhatsApp Step */}
            {step === 'whatsapp' && (
              <div className="space-y-6">
                <div className="text-center">
                  <PhoneIcon className="mx-auto h-12 w-12 text-primary-600 mb-4" />
                  <h2 className="text-lg font-medium text-gray-900 mb-2">
                    Seu WhatsApp
                  </h2>
                  <p className="text-sm text-gray-600">
                    Precisamos do seu número para contato futuro
                  </p>
                </div>

                <div>
                  <label htmlFor="whatsapp" className="block text-sm font-medium text-gray-700 mb-2">
                    Número do WhatsApp
                  </label>
                  <input
                    type="tel"
                    id="whatsapp"
                    value={whatsapp}
                    onChange={(e) => setWhatsapp(formatWhatsapp(e.target.value))}
                    placeholder="(11) 99999-9999"
                    className="input-field"
                    maxLength={15}
                  />
                </div>

                <div>
                  <label htmlFor="comment" className="block text-sm font-medium text-gray-700 mb-2">
                    Comentário (opcional)
                  </label>
                  <textarea
                    id="comment"
                    value={comment}
                    onChange={(e) => setComment(e.target.value)}
                    placeholder="Conte-nos mais sobre sua experiência..."
                    rows={3}
                    className="input-field"
                  />
                </div>

                <button
                  onClick={handleWhatsappSubmit}
                  disabled={!whatsapp.trim()}
                  className="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  Enviar Avaliação
                </button>
              </div>
            )}

            {/* Feedback Step */}
            {step === 'feedback' && (
              <div className="space-y-6">
                <div className="text-center">
                  <ChatBubbleLeftRightIcon className="mx-auto h-12 w-12 text-orange-500 mb-4" />
                  <h2 className="text-lg font-medium text-gray-900 mb-2">
                    Ajude-nos a melhorar
                  </h2>
                  <p className="text-sm text-gray-600">
                    Sua opinião nos ajuda a oferecer um serviço melhor
                  </p>
                </div>

                <div>
                  <label htmlFor="feedback" className="block text-sm font-medium text-gray-700 mb-2">
                    O que podemos melhorar?
                  </label>
                  <textarea
                    id="feedback"
                    value={feedback}
                    onChange={(e) => setFeedback(e.target.value)}
                    placeholder="Conte-nos o que não funcionou bem..."
                    rows={4}
                    className="input-field"
                    required
                  />
                </div>

                <button
                  onClick={handleFeedbackSubmit}
                  disabled={!feedback.trim()}
                  className="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  Enviar Feedback
                </button>
              </div>
            )}

            {/* Success Step */}
            {step === 'success' && (
              <div className="text-center space-y-6">
                <CheckCircleIcon className="mx-auto h-16 w-16 text-green-500" />
                <div>
                  <h2 className="text-xl font-bold text-gray-900 mb-2">
                    Obrigado pela sua avaliação!
                  </h2>
                  <p className="text-gray-600">
                    {rating >= company.positiveThreshold 
                      ? 'Você será redirecionado para o Google em instantes...'
                      : 'Recebemos seu feedback e vamos trabalhar para melhorar!'
                    }
                  </p>
                </div>
                {rating >= company.positiveThreshold && (
                  <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p className="text-sm text-blue-800">
                      Redirecionando para o Google Maps em 3 segundos...
                    </p>
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default ReviewPage;





