import React, { useState, useEffect } from 'react';
import { 
  StarIcon, 
  PhoneIcon,
  FunnelIcon,
  ArrowDownTrayIcon,
  ExclamationTriangleIcon,
  CheckCircleIcon
} from '@heroicons/react/24/outline';

const ReviewsList = () => {
  const [reviews, setReviews] = useState([]);
  const [filter, setFilter] = useState('all'); // all, positive, negative
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Simular carregamento de avaliações
    setTimeout(() => {
      setReviews([
        {
          id: 1,
          company: 'Restaurante XYZ',
          rating: 5,
          whatsapp: '(11) 99999-9999',
          comment: 'Excelente comida e atendimento!',
          feedback: '',
          date: '2025-10-17',
          status: 'positive'
        },
        {
          id: 2,
          company: 'Loja ABC',
          rating: 2,
          whatsapp: '(11) 88888-8888',
          comment: 'Produto não chegou como esperado',
          feedback: 'O produto veio danificado e o atendimento foi ruim',
          date: '2025-10-17',
          status: 'negative'
        },
        {
          id: 3,
          company: 'Café 123',
          rating: 4,
          whatsapp: '(11) 77777-7777',
          comment: 'Muito bom, recomendo!',
          feedback: '',
          date: '2025-10-16',
          status: 'positive'
        },
        {
          id: 4,
          company: 'Farmácia DEF',
          rating: 1,
          whatsapp: '(11) 66666-6666',
          comment: 'Horrível',
          feedback: 'Demorou muito para entregar o medicamento',
          date: '2025-10-16',
          status: 'negative'
        },
        {
          id: 5,
          company: 'Supermercado GHI',
          rating: 5,
          whatsapp: '(11) 55555-5555',
          comment: 'Preços ótimos e produtos frescos',
          feedback: '',
          date: '2025-10-15',
          status: 'positive'
        }
      ]);
      setLoading(false);
    }, 1000);
  }, []);

  const filteredReviews = reviews.filter(review => {
    if (filter === 'positive') return review.status === 'positive';
    if (filter === 'negative') return review.status === 'negative';
    return true;
  });

  const exportReviews = () => {
    const csvContent = [
      ['Empresa', 'Avaliação', 'WhatsApp', 'Comentário', 'Feedback', 'Data'],
      ...filteredReviews.map(review => [
        review.company,
        review.rating,
        review.whatsapp,
        review.comment,
        review.feedback,
        review.date
      ])
    ].map(row => row.join(',')).join('\n');

    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `avaliacoes_${filter}_${new Date().toISOString().split('T')[0]}.csv`;
    a.click();
    window.URL.revokeObjectURL(url);
  };

  if (loading) {
    return (
      <div className="flex items-center justify-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="md:flex md:items-center md:justify-between">
        <div className="min-w-0 flex-1">
          <h2 className="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            Avaliações
          </h2>
          <p className="mt-1 text-sm text-gray-500">
            Gerencie todas as avaliações recebidas
          </p>
        </div>
        <div className="mt-4 flex space-x-3 md:ml-4 md:mt-0">
          <button
            onClick={exportReviews}
            className="btn-secondary flex items-center"
          >
            <ArrowDownTrayIcon className="h-4 w-4 mr-2" />
            Exportar CSV
          </button>
        </div>
      </div>

      {/* Filters */}
      <div className="card">
        <div className="flex items-center space-x-4">
          <FunnelIcon className="h-5 w-5 text-gray-400" />
          <div className="flex space-x-2">
            <button
              onClick={() => setFilter('all')}
              className={`px-3 py-1 rounded-full text-sm font-medium ${
                filter === 'all'
                  ? 'bg-primary-100 text-primary-700'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Todas ({reviews.length})
            </button>
            <button
              onClick={() => setFilter('positive')}
              className={`px-3 py-1 rounded-full text-sm font-medium ${
                filter === 'positive'
                  ? 'bg-green-100 text-green-700'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Positivas ({reviews.filter(r => r.status === 'positive').length})
            </button>
            <button
              onClick={() => setFilter('negative')}
              className={`px-3 py-1 rounded-full text-sm font-medium ${
                filter === 'negative'
                  ? 'bg-red-100 text-red-700'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              }`}
            >
              Negativas ({reviews.filter(r => r.status === 'negative').length})
            </button>
          </div>
        </div>
      </div>

      {/* Reviews List */}
      <div className="space-y-4">
        {filteredReviews.map((review) => (
          <div key={review.id} className="card">
            <div className="flex items-start justify-between">
              <div className="flex-1">
                <div className="flex items-center space-x-3 mb-2">
                  <h3 className="text-lg font-medium text-gray-900">
                    {review.company}
                  </h3>
                  <div className="flex">
                    {[...Array(5)].map((_, i) => (
                      <StarIcon
                        key={i}
                        className={`h-5 w-5 ${
                          i < review.rating ? 'text-yellow-400' : 'text-gray-300'
                        }`}
                        fill={i < review.rating ? 'currentColor' : 'none'}
                      />
                    ))}
                  </div>
                  <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                    review.status === 'positive'
                      ? 'bg-green-100 text-green-800'
                      : 'bg-red-100 text-red-800'
                  }`}>
                    {review.status === 'positive' ? (
                      <CheckCircleIcon className="h-3 w-3 mr-1" />
                    ) : (
                      <ExclamationTriangleIcon className="h-3 w-3 mr-1" />
                    )}
                    {review.status === 'positive' ? 'Positiva' : 'Negativa'}
                  </span>
                </div>
                
                <div className="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                  <div className="flex items-center">
                    <PhoneIcon className="h-4 w-4 mr-1" />
                    {review.whatsapp}
                  </div>
                  <div>{review.date}</div>
                </div>

                {review.comment && (
                  <div className="mb-3">
                    <p className="text-sm text-gray-700">
                      <span className="font-medium">Comentário:</span> {review.comment}
                    </p>
                  </div>
                )}

                {review.feedback && (
                  <div className="bg-orange-50 border border-orange-200 rounded-lg p-3">
                    <p className="text-sm text-orange-800">
                      <span className="font-medium">Feedback:</span> {review.feedback}
                    </p>
                  </div>
                )}
              </div>
            </div>
          </div>
        ))}
      </div>

      {filteredReviews.length === 0 && (
        <div className="text-center py-12">
          <ChatBubbleLeftRightIcon className="mx-auto h-12 w-12 text-gray-400" />
          <h3 className="mt-2 text-sm font-medium text-gray-900">Nenhuma avaliação encontrada</h3>
          <p className="mt-1 text-sm text-gray-500">
            Não há avaliações para o filtro selecionado.
          </p>
        </div>
      )}
    </div>
  );
};

export default ReviewsList;

