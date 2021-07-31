<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Notice;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notice::query()->delete();
        News::query()->delete();

        foreach ($this->getNotices() as $data) {
            Notice::firstOrCreate($data);
        }

        foreach ($this->getNews() as $data) {
            News::firstOrCreate($data);
        }
    }

    /**
     * @return array
     */
    protected function getNotices(): array
    {
        return [
            [
                'priority' => 10,
                'title'    => 'Hygieneregeln für den Schießbetrieb',
                'content'  => "Nach der neuen Landesverordnung zur Eindämmung des Covid-19-Virus passen wir unsere Hygieneregeln zum Schutz unserer Sportlerinnen und Sportler entsprechend an und verpflichten uns, folgende Infektionsgrundsätze und Hygieneregeln einzuhalten:\n\n1. Allgemeines\n• Im Gastraum sind ein Mindestabstand von 1,5 Metern zwischen Personen, die nicht im selben Haushalt leben, und die geltenden Vorschriften für Gaststätten einzuhalten.\n• Personen mit Atemwegs-Symptomen (sofern nicht z.B. vom Arzt bescheinigte, abgeklärte Erkältung) sind vom Trainingsbetrieb ausgeschlossen.\n• Bei Verdachtsfällen sind wir befugt, der betroffenen Person den Zugang zur Schützenhalle zu verwehren.\n• Sollte bei einem Vereinsmitglied bis 14 Tage nach dem Training ein positiver CORONA- Test vorliegen, hat dieses unverzüglich den Vorstand darüber zu informieren.\n• Eine Anwesenheitsliste für das Training und den Aufenthalt im Gastraum mit Namen, Vornamen und Anwesenheitszeit werden an jedem Öffnungstag der Schützenhalle geführt.\n• Zugang zum Schießstand ist nur über den Unterstand durch die Schützenhalle gestattet.\n• Als Ausgang ist die Tür bei den WC-Räumen zu benutzen.\n• Vor Betreten der Schützenhalle sind die Hände mit dem zur Verfügung gestellten Desinfektionsmittel zu desinfizieren.\n• Bei Wahrung des Abstandsgebotes kann auf das Tragen eines Mund-Nasen-Schutzes verzichtet werden.\n• Training ist während der Trainingszeiten von 18:30 Uhr bis 21:00 Uhr, mittwochs und freitags, nur nach Anmeldung bei den Sportwarten möglich;\n◦ Telefonisch/WhatsApp (0163 – 41 45 99 3) oder\n◦ per E-Mail (sportwart@weidmannsheil-lieth.de)\n• Wir empfehlen die Installation und Nutzung der offiziellen Corona-Warn-App vom Robert-Koch-Institut auf allen Smartphones, um mögliche Infektionsketten schneller zu unterbrechen.\n\n2. Handlungsanweisungen für Verdachtsfälle\nBei auftretenden Verdachtsfällen ist die Aufsicht berechtigt, den Sportler oder die Sportlerin vom Trainingsbetrieb auszuschließen.\n\n3. Zutritt vereinsfremder Personen zum Trainingsgelände\nZutritt zum Training haben nur Vereinsmitglieder der Schützenbrüderschaft Weidmannsheil Klein Nordende Lieth und Mitglieder befreundeter Schützenvereine nach Anmeldung. Ein Anfängertraining (Schnuppertraining) findet zurzeit nicht statt.\n\n4. Maßnahmen zur Gewährleistung des Mindestabstands von 1,5 m\nAufgrund der aktuellen Verordnung vom Land Schleswig-Holstein können wieder alle Schießstände (Luftgewehr und KK) belegt werden. Es dürfen sich lediglich so viele Schützen auf dem jeweiligen Stand aufhalten, wie Stände vorhanden sind (Luftgewehr = 8 Stände, KK = 6 Stände), zuzüglich der Standaufsicht.\n\n5. Desinfektion & Hygiene\nDie vom Robert-Koch-Institut empfohlenen Hygieneregeln sind zu beachten. Hierzu gilt:\n• Auf Begrüßung durch Händeschütteln oder Umarmung ist zu verzichten.\n• Niesen oder Husten in die Armbeuge oder in ein Taschentuch\n• Benutzen von Einmaltaschentüchern\n• Entsorgung der Taschentücher in den dafür vorgesehenen Behältnissen\n• Nach Beendigung des Trainings ist der Platz zügig und ohne Gruppenbildung zu verlassen\n• Die Vereinswaffen werden nach der Benutzung vom Sportler mit dem bereitgestellten Desinfektionsmittel gründlich desinfiziert\n\n6. Unterweisung der Mitarbeiter und aktive Kommunikation\nDie Sportlerinnen und Sportler des Schützenvereins sind über den Inhalt dieses Dokumentes informiert.\nBei Zuwiderhandlung kann die Sportlerin / der Sportler vom Training ausgeschlossen werden. Der Ausschluss kann befristet oder unbefristet erfolgen.\n\nStand: Juli 2020"
            ],
            [
                'priority' => 20,
                'title'    => 'Coronabedingte Schließung',
                'content'  => "Am Mittwoch, den 28.10.2020, wurden von der Bundesregierung neue Maßnahmen zur Eindämmung des Coronavirus beschlossen. Auch wir müssen daher unsere Schützenhalle ab Montag, den 02.11.2020, bis Ende November 2020 schließen.\n\nWir hoffen auf Euer Verständnis und verbleiben bis dahin mit vielen lieben Grüßen\ndie Schützenbrüderschaft Weidmannsheil Klein Nordende Lieth v. 1919 e.V."
            ]
        ];
    }

    protected function getNews(): array
    {
        return [
            [
                'priority'  => 10,
                'title'     => 'Schützenfest',
                'content'   => 'Aus aktuellem Anlass sehen wir uns leider gezwungen unser diesjähriges Schützenfest abzusagen.',
                'image_url' => 'https://weidmannsheil-lieth.de/assets/aktuelles/1.jpg'
            ]
        ];
    }
}
