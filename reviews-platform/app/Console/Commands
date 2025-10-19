<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\Review;
use App\Models\ReviewPage;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ExportDataForSeeder extends Command
{
    protected $signature = 'data:export-seeder {--file=exported_data.php}';
    protected $description = 'Exporta dados atuais para criar seeders';

    public function handle()
    {
        $filename = $this->option('file');
        $filepath = database_path("seeders/{$filename}");

        $this->info('🔄 Exportando dados para seeder...');

        $data = [
            'users' => $this->exportUsers(),
            'companies' => $this->exportCompanies(),
            'review_pages' => $this->exportReviewPages(),
            'reviews' => $this->exportReviews(),
        ];

        $this->generateSeederFile($filepath, $data);

        $this->info("✅ Dados exportados para: {$filepath}");
        $this->info('');
        $this->info('📊 Resumo exportado:');
        $this->info("   • {$data['users']->count()} usuários");
        $this->info("   • {$data['companies']->count()} empresas");
        $this->info("   • {$data['review_pages']->count()} páginas de avaliação");
        $this->info("   • {$data['reviews']->count()} avaliações");
        $this->info('');
        $this->info('🚀 Para usar os dados:');
        $this->info("   1. Renomeie o arquivo para: RealDataSeeder.php");
        $this->info("   2. Execute: php artisan db:seed --class=RealDataSeeder");
    }

    private function exportUsers()
    {
        return User::all()->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password, // Hash já aplicado
                'role' => $user->role,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
        });
    }

    private function exportCompanies()
    {
        return Company::all()->map(function ($company) {
            return [
                'name' => $company->name,
                'email' => $company->email,
                'phone' => $company->phone,
                'address' => $company->address,
                'google_review_url' => $company->google_review_url,
                'positive_threshold' => $company->positive_threshold,
                'logo_path' => $company->logo_path,
                'background_image_path' => $company->background_image_path,
                'custom_css' => $company->custom_css,
                'is_active' => $company->is_active,
                'description' => $company->description,
                'created_at' => $company->created_at,
                'updated_at' => $company->updated_at,
            ];
        });
    }

    private function exportReviewPages()
    {
        return ReviewPage::all()->map(function ($page) {
            return [
                'company_id' => $page->company_id,
                'token' => $page->token,
                'created_at' => $page->created_at,
                'updated_at' => $page->updated_at,
            ];
        });
    }

    private function exportReviews()
    {
        return Review::all()->map(function ($review) {
            return [
                'company_id' => $review->company_id,
                'review_page_id' => $review->review_page_id,
                'rating' => $review->rating,
                'whatsapp' => $review->whatsapp,
                'comment' => $review->comment,
                'feedback' => $review->feedback,
                'is_positive' => $review->is_positive,
                'redirected_to_google' => $review->redirected_to_google,
                'ip_address' => $review->ip_address,
                'user_agent' => $review->user_agent,
                'created_at' => $review->created_at,
                'updated_at' => $review->updated_at,
            ];
        });
    }

    private function generateSeederFile($filepath, $data)
    {
        $content = "<?php\n\n";
        $content .= "namespace Database\Seeders;\n\n";
        $content .= "use Illuminate\Database\Seeder;\n";
        $content .= "use App\Models\Company;\n";
        $content .= "use App\Models\ReviewPage;\n";
        $content .= "use App\Models\Review;\n";
        $content .= "use App\Models\User;\n";
        $content .= "use Illuminate\Support\Facades\Hash;\n\n";
        $content .= "class RealDataSeeder extends Seeder\n";
        $content .= "{\n";
        $content .= "    public function run(): void\n";
        $content .= "    {\n";
        $content .= "        \$this->command->info('🔄 Importando dados reais...');\n\n";

        // Users
        if ($data['users']->count() > 0) {
            $content .= "        // Criar usuários\n";
            foreach ($data['users'] as $user) {
                $content .= "        User::create([\n";
                $content .= "            'name' => " . $this->formatValue($user['name']) . ",\n";
                $content .= "            'email' => " . $this->formatValue($user['email']) . ",\n";
                $content .= "            'password' => " . $this->formatValue($user['password']) . ",\n";
                $content .= "            'role' => " . $this->formatValue($user['role']) . ",\n";
                if ($user['email_verified_at']) {
                    $content .= "            'email_verified_at' => " . $this->formatValue($user['email_verified_at']) . ",\n";
                }
                $content .= "        ]);\n\n";
            }
        }

        // Companies
        if ($data['companies']->count() > 0) {
            $content .= "        // Criar empresas\n";
            foreach ($data['companies'] as $company) {
                $content .= "        \$company" . $company['id'] . " = Company::create([\n";
                $content .= "            'name' => " . $this->formatValue($company['name']) . ",\n";
                $content .= "            'email' => " . $this->formatValue($company['email']) . ",\n";
                if ($company['phone']) {
                    $content .= "            'phone' => " . $this->formatValue($company['phone']) . ",\n";
                }
                if ($company['address']) {
                    $content .= "            'address' => " . $this->formatValue($company['address']) . ",\n";
                }
                if ($company['google_review_url']) {
                    $content .= "            'google_review_url' => " . $this->formatValue($company['google_review_url']) . ",\n";
                }
                $content .= "            'positive_threshold' => " . $company['positive_threshold'] . ",\n";
                if ($company['logo_path']) {
                    $content .= "            'logo_path' => " . $this->formatValue($company['logo_path']) . ",\n";
                }
                if ($company['background_image_path']) {
                    $content .= "            'background_image_path' => " . $this->formatValue($company['background_image_path']) . ",\n";
                }
                if ($company['custom_css']) {
                    $content .= "            'custom_css' => " . $this->formatValue($company['custom_css']) . ",\n";
                }
                $content .= "            'is_active' => " . ($company['is_active'] ? 'true' : 'false') . ",\n";
                if ($company['description']) {
                    $content .= "            'description' => " . $this->formatValue($company['description']) . ",\n";
                }
                $content .= "        ]);\n\n";
            }
        }

        // Review Pages
        if ($data['review_pages']->count() > 0) {
            $content .= "        // Criar páginas de avaliação\n";
            foreach ($data['review_pages'] as $page) {
                $content .= "        \$page" . $page['id'] . " = ReviewPage::create([\n";
                $content .= "            'company_id' => \$company" . $page['company_id'] . "->id,\n";
                $content .= "            'token' => " . $this->formatValue($page['token']) . ",\n";
                $content .= "        ]);\n\n";
            }
        }

        // Reviews
        if ($data['reviews']->count() > 0) {
            $content .= "        // Criar avaliações\n";
            foreach ($data['reviews'] as $review) {
                $content .= "        Review::create([\n";
                $content .= "            'company_id' => \$company" . $review['company_id'] . "->id,\n";
                $content .= "            'review_page_id' => \$page" . $review['review_page_id'] . "->id,\n";
                $content .= "            'rating' => " . $review['rating'] . ",\n";
                if ($review['whatsapp']) {
                    $content .= "            'whatsapp' => " . $this->formatValue($review['whatsapp']) . ",\n";
                }
                if ($review['comment']) {
                    $content .= "            'comment' => " . $this->formatValue($review['comment']) . ",\n";
                }
                if ($review['feedback']) {
                    $content .= "            'feedback' => " . $this->formatValue($review['feedback']) . ",\n";
                }
                $content .= "            'is_positive' => " . ($review['is_positive'] ? 'true' : 'false') . ",\n";
                $content .= "            'redirected_to_google' => " . ($review['redirected_to_google'] ? 'true' : 'false') . ",\n";
                if ($review['ip_address']) {
                    $content .= "            'ip_address' => " . $this->formatValue($review['ip_address']) . ",\n";
                }
                if ($review['user_agent']) {
                    $content .= "            'user_agent' => " . $this->formatValue($review['user_agent']) . ",\n";
                }
                $content .= "        ]);\n\n";
            }
        }

        $content .= "        \$this->command->info('✅ Dados importados com sucesso!');\n";
        $content .= "    }\n";
        $content .= "}\n";

        File::put($filepath, $content);
    }

    private function formatValue($value)
    {
        if (is_null($value)) {
            return 'null';
        }
        
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        
        if (is_numeric($value)) {
            return $value;
        }
        
        return "'" . addslashes($value) . "'";
    }
}
