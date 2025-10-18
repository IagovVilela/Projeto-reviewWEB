import React, { useState, useEffect } from 'react';
import { 
  BuildingOfficeIcon, 
  ChatBubbleLeftRightIcon, 
  StarIcon,
  ExclamationTriangleIcon,
  ArrowTrendingUpIcon,
  ArrowTrendingDownIcon
} from '@heroicons/react/24/outline';
import { Link } from 'react-router-dom';

const Dashboard = () => {
  const [stats, setStats] = useState({
    totalCompanies: 0,
    totalReviews: 0,
    averageRating: 0,
    negativeReviews: 0,
    positiveReviews: 0,
    recentReviews: []
  });

  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Simular carregamento de dados
    setTimeout(() => {
      setStats({
        totalCompanies: 12,
        totalReviews: 156,
        averageRating: 4.2,
        negativeReviews: 8,
        positiveReviews: 148,
        recentReviews: [
          { id: 1, company: 'Restaurante XYZ', rating: 5, whatsapp: '(11) 99999-9999', date: '2025-10-17' },
          { id: 2, company: 'Loja ABC', rating: 2, whatsapp: '(11) 88888-8888', date: '2025-10-17' },
          { id: 3, company: 'Café 123', rating: 4, whatsapp: '(11) 77777-7777', date: '2025-10-16' },
        ]
      });
      setLoading(false);
    }, 1000);
  }, []);

  const statCards = [
    {
      name: 'Total de Empresas',
      value: stats.totalCompanies,
      icon: BuildingOfficeIcon,
      color: 'bg-blue-500',
      change: '+2',
      changeType: 'positive'
    },
    {
      name: 'Total de Avaliações',
      value: stats.totalReviews,
      icon: ChatBubbleLeftRightIcon,
      color: 'bg-green-500',
      change: '+12',
      changeType: 'positive'
    },
    {
      name: 'Avaliação Média',
      value: stats.averageRating.toFixed(1),
      icon: StarIcon,
      color: 'bg-yellow-500',
      change: '+0.2',
      changeType: 'positive'
    },
    {
      name: 'Avaliações Negativas',
      value: stats.negativeReviews,
      icon: ExclamationTriangleIcon,
      color: 'bg-red-500',
      change: '-1',
      changeType: 'negative'
    }
  ];

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
            Dashboard
          </h2>
          <p className="mt-1 text-sm text-gray-500">
            Visão geral da plataforma de avaliações
          </p>
        </div>
        <div className="mt-4 flex md:ml-4 md:mt-0">
          <Link
            to="/companies"
            className="btn-primary"
          >
            Nova Empresa
          </Link>
        </div>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        {statCards.map((card) => (
          <div key={card.name} className="card">
            <div className="flex items-center">
              <div className="flex-shrink-0">
                <div className={`${card.color} p-3 rounded-lg`}>
                  <card.icon className="h-6 w-6 text-white" />
                </div>
              </div>
              <div className="ml-5 w-0 flex-1">
                <dl>
                  <dt className="text-sm font-medium text-gray-500 truncate">
                    {card.name}
                  </dt>
                  <dd className="flex items-baseline">
                    <div className="text-2xl font-semibold text-gray-900">
                      {card.value}
                    </div>
                    <div className={`ml-2 flex items-baseline text-sm font-semibold ${
                      card.changeType === 'positive' ? 'text-green-600' : 'text-red-600'
                    }`}>
                      {card.changeType === 'positive' ? (
                        <ArrowTrendingUpIcon className="h-4 w-4 flex-shrink-0 self-center" />
                      ) : (
                        <ArrowTrendingDownIcon className="h-4 w-4 flex-shrink-0 self-center" />
                      )}
                      <span className="sr-only">
                        {card.changeType === 'positive' ? 'Increased' : 'Decreased'} by
                      </span>
                      {card.change}
                    </div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Recent Reviews */}
      <div className="card">
        <h3 className="text-lg font-medium text-gray-900 mb-4">Avaliações Recentes</h3>
        <div className="flow-root">
          <ul className="-my-5 divide-y divide-gray-200">
            {stats.recentReviews.map((review) => (
              <li key={review.id} className="py-5">
                <div className="flex items-center space-x-4">
                  <div className="flex-shrink-0">
                    <div className={`p-2 rounded-lg ${
                      review.rating >= 4 ? 'bg-green-100' : 'bg-red-100'
                    }`}>
                      <StarIcon className={`h-5 w-5 ${
                        review.rating >= 4 ? 'text-green-600' : 'text-red-600'
                      }`} />
                    </div>
                  </div>
                  <div className="flex-1 min-w-0">
                    <p className="text-sm font-medium text-gray-900 truncate">
                      {review.company}
                    </p>
                    <p className="text-sm text-gray-500 truncate">
                      WhatsApp: {review.whatsapp}
                    </p>
                  </div>
                  <div className="flex items-center space-x-2">
                    <div className="flex">
                      {[...Array(5)].map((_, i) => (
                        <StarIcon
                          key={i}
                          className={`h-4 w-4 ${
                            i < review.rating ? 'text-yellow-400' : 'text-gray-300'
                          }`}
                          fill={i < review.rating ? 'currentColor' : 'none'}
                        />
                      ))}
                    </div>
                    <span className="text-sm text-gray-500">{review.date}</span>
                  </div>
                </div>
              </li>
            ))}
          </ul>
        </div>
        <div className="mt-6">
          <Link
            to="/reviews"
            className="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
          >
            Ver todas as avaliações
          </Link>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;

