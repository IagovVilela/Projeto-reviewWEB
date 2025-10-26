@extends('layouts.admin')

@section('title', __('companies.title') . ' - Reviews Platform')

@section('page-title', __('companies.title'))
@section('page-description', __('dashboard.companies_count') . ' • ' . $companies->where('status', 'published')->count() . ' ' . __('companies.count_active') . ' • ' . $companies->where('status', 'draft')->count() . ' ' . __('companies.count_draft'))

@section('header-actions')
    <a href="/companies/create" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-plus mr-2"></i>
        {{ __('companies.create') }}
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            @if(session('company_url'))
                <div class="mt-2">
                    <a href="{{ session('company_url') }}" target="_blank" class="text-green-600 hover:underline font-medium">
                        <i class="fas fa-external-link-alt mr-1"></i>
                        Ver página pública
                    </a>
                </div>
            @endif
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($companies->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($companies as $company)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover stagger-item">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            @if($company->logo_url)
                                <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-building text-purple-600"></i>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $company->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $company->created_at ? $company->created_at->format('d/m/Y') : '' }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $company->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $company->status === 'published' ? __('companies.active') : __('companies.draft') }}
                            </span>
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $company->is_active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $company->is_active ? __('companies.visible') : __('companies.hidden') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-envelope w-4 mr-2"></i>
                            <span class="truncate">{{ $company->negative_email }}</span>
                        </div>
                        @if($company->contact_number)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-phone w-4 mr-2"></i>
                                <span>{{ $company->contact_number }}</span>
                            </div>
                        @endif
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-star w-4 mr-2"></i>
                            <span>{{ __('companies.rating_limit', ['score' => $company->positive_score]) }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4 py-3 border-t border-b border-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt mr-1"></i>
                            <span>{{ $company->review_pages_count }} {{ __('companies.pages') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-comment mr-1"></i>
                            <span>{{ $company->reviews_count }} {{ __('companies.reviews_count') }}</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        @if($company->status === 'published')
                            <a href="{{ $company->public_url }}" target="_blank" class="flex-1 bg-blue-50 text-blue-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors text-center">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                {{ __('companies.view_page') }}
                            </a>
                        @else
                            <a href="{{ route('companies.edit', $company->id) }}" class="flex-1 bg-purple-50 text-purple-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-purple-100 transition-colors text-center">
                                <i class="fas fa-edit mr-1"></i>
                                {{ __('companies.edit_company') }}
                            </a>
                        @endif
                        <form method="POST" action="{{ route('companies.destroy', $company->id) }}" class="inline" onsubmit="return confirm('{{ __('companies.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $companies->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full mb-6">
                <i class="fas fa-building text-purple-600 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('companies.no_companies') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('companies.no_companies_desc') }}</p>
            <a href="/companies/create" class="btn-primary text-white px-6 py-3 rounded-lg font-medium inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                {{ __('companies.create_first') }}
            </a>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        // Enhanced animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to buttons
            document.querySelectorAll('.btn-primary, .btn-secondary').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        top: ${y}px;
                        left: ${x}px;
                        background: rgba(255, 255, 255, 0.5);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });
            
            // Add hover parallax effect to cards (disabled to prevent button issues)
            // Parallax effect can interfere with button clicks and hover states
            document.querySelectorAll('.card-hover').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    // Simple hover effect without transforms
                    this.style.transition = 'box-shadow 0.3s ease, transform 0.3s ease';
                });
                
                card.addEventListener('mouseleave', function() {
                    // Ensure transition remains
                    this.style.transition = 'box-shadow 0.3s ease, transform 0.3s ease';
                });
            });
        });
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
@endsection
