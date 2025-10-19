import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Dashboard from './components/Dashboard';
import CompanyForm from './components/CompanyForm';
import ReviewsList from './components/ReviewsList';
import ReviewPage from './components/ReviewPage';
import Layout from './components/Layout';

function App() {
  return (
    <Router>
      <div className="min-h-screen bg-gray-50">
        <Routes>
          {/* Rotas administrativas */}
          <Route path="/" element={<Layout><Dashboard /></Layout>} />
          <Route path="/companies" element={<Layout><CompanyForm /></Layout>} />
          <Route path="/reviews" element={<Layout><ReviewsList /></Layout>} />
          
          {/* Rota pública para avaliações */}
          <Route path="/r/:token" element={<ReviewPage />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;





