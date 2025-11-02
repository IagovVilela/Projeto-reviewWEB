<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactsExport extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $contacts;
    public $period;
    public $csvPath;

    /**
     * Create a new message instance.
     */
    public function __construct(Company $company, array $contacts, string $period = 'semanal')
    {
        $this->company = $company;
        $this->contacts = $contacts;
        $this->period = $period;
        $this->csvPath = $this->generateCSV($contacts);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $periodLabel = $this->period === 'diario' ? 'Diário' : ($this->period === 'semanal' ? 'Semanal' : 'Mensal');
        
        return new Envelope(
            subject: "📊 Relatório {$periodLabel} de Contatos - {$this->company->name}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $periodLabel = $this->period === 'diario' ? 'diário' : ($this->period === 'semanal' ? 'semanal' : 'mensal');
        
        return new Content(
            view: 'emails.contacts-export',
            with: [
                'company' => $this->company,
                'contacts' => $this->contacts,
                'contactsCount' => count($this->contacts),
                'period' => $periodLabel,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        if (!$this->csvPath || !file_exists($this->csvPath)) {
            return [];
        }

        return [
            Attachment::fromPath($this->csvPath)
                ->as("contatos_{$this->company->name}_" . date('Y-m-d') . ".csv")
                ->withMime('text/csv'),
        ];
    }

    /**
     * Generate CSV file with contacts
     */
    private function generateCSV(array $contacts): ?string
    {
        if (empty($contacts)) {
            return null;
        }

        $filename = 'exports/contacts_' . $this->company->id . '_' . time() . '.csv';
        $path = storage_path('app/' . $filename);

        // Ensure directory exists
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $file = fopen($path, 'w');

        // BOM para UTF-8 (Excel compatibility)
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        // Headers
        fputcsv($file, ['Data', 'Nota', 'WhatsApp', 'Comentário', 'Feedback', 'Tipo'], ';');

        // Data
        foreach ($contacts as $contact) {
            fputcsv($file, [
                $contact['Data'] ?? '',
                $contact['Nota'] ?? '',
                $contact['WhatsApp'] ?? '',
                $contact['Comentário'] ?? '',
                $contact['Feedback'] ?? '',
                $contact['Tipo'] ?? '',
            ], ';');
        }

        fclose($file);

        return $path;
    }

    /**
     * Clean up CSV file after sending
     */
    public function __destruct()
    {
        if ($this->csvPath && file_exists($this->csvPath)) {
            @unlink($this->csvPath);
        }
    }
}


