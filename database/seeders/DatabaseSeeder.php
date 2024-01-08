<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\Club;
use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\Guide;
use App\Models\Player;
use App\Models\PlayerPosition;
use App\Models\SessionGroup;
use App\Models\Tag;
use App\Models\Team;
use App\Models\TrainingPlan;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Permissions
        $permission = Permission::create(['name' => 'access admin panel']);

        // Roles
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo($permission);

        $role = Role::create(['name' => 'club admin']);
        $role->givePermissionTo($permission);

        $role = Role::create(['name' => 'coach']);

        // Users
        $users = [
            ['name' => 'Troels Johnsen', 'email' => 'tjo@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'Thomas Prip Vestergaard', 'email' => 'tpv@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'Emil Breilev Vinther', 'email' => 'ebv@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'Christian Sørensen', 'email' => 'cso@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'Kenneth Carlsen', 'email' => 'kec@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'Christian Larsen', 'email' => 'cla@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'Bjørn Holm', 'email' => 'bho@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'Jonas Lind Bliksted', 'email' => 'jlb@brondby.com', 'club_id' => 1, 'role' => 'admin'],
            ['name' => 'BK FREM', 'email' => 'frem@brondby.com', 'club_id' => 7, 'role' => 'club admin'],

            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller@brondby.com'],
            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller1@brondby.com'],
            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller2@brondby.com'],
            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller3@brondby.com'],
            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller4@brondby.com'],
            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller5@brondby.com'],
            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller6@brondby.com'],
            //            ['name' => 'Spiller Brøndby', 'email' => 'spiller7@brondby.com'],
            //
            //            ['name' => 'Spiller AB Tårnby', 'email' => 'spiller8@brondby.com'],
            //            ['name' => 'Spiller AB Tårnby', 'email' => 'spiller9@brondby.com'],
            //            ['name' => 'Spiller AB Tårnby', 'email' => 'spiller10@brondby.com'],
            //            ['name' => 'Spiller AB Tårnby', 'email' => 'spiller11@brondby.com'],
            //            ['name' => 'Spiller AB Tårnby', 'email' => 'spiller12@brondby.com'],
            //            ['name' => 'Spiller AB Tårnby', 'email' => 'spiller13@brondby.com'],
            //            ['name' => 'Spiller AB Tårnby', 'email' => 'spiller14@brondby.com'],
            //
            //            ['name' => 'Spiller AIK Strøby', 'email' => 'spiller15@brondby.com'],
            //            ['name' => 'Spiller AIK Strøby', 'email' => 'spiller16@brondby.com'],
            //            ['name' => 'Spiller AIK Strøby', 'email' => 'spiller17@brondby.com'],
            //            ['name' => 'Spiller AIK Strøby', 'email' => 'spiller18@brondby.com'],
            //            ['name' => 'Spiller AIK Strøby', 'email' => 'spiller19@brondby.com'],
            //            ['name' => 'Spiller AIK Strøby', 'email' => 'spiller20@brondby.com'],
            //            ['name' => 'Spiller AIK Strøby', 'email' => 'spiller21@brondby.com'],
            //
            //            ['name' => 'Spiller Albertslund IF', 'email' => 'spiller22@brondby.com'],
            //            ['name' => 'Spiller Albertslund IF', 'email' => 'spiller23@brondby.com'],
            //            ['name' => 'Spiller Albertslund IF', 'email' => 'spiller24@brondby.com'],
            //            ['name' => 'Spiller Albertslund IF', 'email' => 'spiller25@brondby.com'],
            //            ['name' => 'Spiller Albertslund IF', 'email' => 'spiller26@brondby.com'],
            //            ['name' => 'Spiller Albertslund IF', 'email' => 'spiller27@brondby.com'],
            //            ['name' => 'Spiller Albertslund IF', 'email' => 'spiller28@brondby.com'],
            //
            //            ['name' => 'Spiller Ballerup-Skovlunde Fodbold', 'email' => 'spiller29@brondby.com'],
            //            ['name' => 'Spiller Ballerup-Skovlunde Fodbold', 'email' => 'spiller30@brondby.com'],
            //            ['name' => 'Spiller Ballerup-Skovlunde Fodbold', 'email' => 'spiller31@brondby.com'],
            //            ['name' => 'Spiller Ballerup-Skovlunde Fodbold', 'email' => 'spiller32@brondby.com'],
            //            ['name' => 'Spiller Ballerup-Skovlunde Fodbold', 'email' => 'spiller33@brondby.com'],
            //            ['name' => 'Spiller Ballerup-Skovlunde Fodbold', 'email' => 'spiller34@brondby.com'],
            //            ['name' => 'Spiller Ballerup-Skovlunde Fodbold', 'email' => 'spiller35@brondby.com'],
            //
            //            ['name' => 'Spiller BK Avarta', 'email' => 'spiller36@brondby.com'],
            //            ['name' => 'Spiller BK Avarta', 'email' => 'spiller37@brondby.com'],
            //            ['name' => 'Spiller BK Avarta', 'email' => 'spiller38@brondby.com'],
            //            ['name' => 'Spiller BK Avarta', 'email' => 'spiller39@brondby.com'],
            //            ['name' => 'Spiller BK Avarta', 'email' => 'spiller40@brondby.com'],
            //            ['name' => 'Spiller BK Avarta', 'email' => 'spiller41@brondby.com'],
            //            ['name' => 'Spiller BK Avarta', 'email' => 'spiller42@brondby.com'],
            //
            //            ['name' => 'Spiller BK FREM', 'email' => 'spiller43@brondby.com'],
            //            ['name' => 'Spiller BK FREM', 'email' => 'spiller44@brondby.com'],
            //            ['name' => 'Spiller BK FREM', 'email' => 'spiller45@brondby.com'],
            //            ['name' => 'Spiller BK FREM', 'email' => 'spiller46@brondby.com'],
            //            ['name' => 'Spiller BK FREM', 'email' => 'spiller47@brondby.com'],
            //            ['name' => 'Spiller BK FREM', 'email' => 'spiller48@brondby.com'],
            //            ['name' => 'Spiller BK FREM', 'email' => 'spiller49@brondby.com'],
            //
            //            ['name' => 'Spiller BK Friheden', 'email' => 'spiller50@brondby.com'],
            //            ['name' => 'Spiller BK Friheden', 'email' => 'spiller51@brondby.com'],
            //            ['name' => 'Spiller BK Friheden', 'email' => 'spiller52@brondby.com'],
            //            ['name' => 'Spiller BK Friheden', 'email' => 'spiller53@brondby.com'],
            //            ['name' => 'Spiller BK Friheden', 'email' => 'spiller54@brondby.com'],
            //            ['name' => 'Spiller BK Friheden', 'email' => 'spiller55@brondby.com'],
            //            ['name' => 'Spiller BK Friheden', 'email' => 'spiller56@brondby.com'],
            //
            //            ['name' => 'Spiller BK Rødovre', 'email' => 'spiller57@brondby.com'],
            //            ['name' => 'Spiller BK Rødovre', 'email' => 'spiller58@brondby.com'],
            //            ['name' => 'Spiller BK Rødovre', 'email' => 'spiller59@brondby.com'],
            //            ['name' => 'Spiller BK Rødovre', 'email' => 'spiller60@brondby.com'],
            //            ['name' => 'Spiller BK Rødovre', 'email' => 'spiller61@brondby.com'],
            //            ['name' => 'Spiller BK Rødovre', 'email' => 'spiller62@brondby.com'],
            //            ['name' => 'Spiller BK Rødovre', 'email' => 'spiller63@brondby.com'],
            //
            //            ['name' => 'Spiller BK Union', 'email' => 'spiller64@brondby.com'],
            //            ['name' => 'Spiller BK Union', 'email' => 'spiller65@brondby.com'],
            //            ['name' => 'Spiller BK Union', 'email' => 'spiller66@brondby.com'],
            //            ['name' => 'Spiller BK Union', 'email' => 'spiller67@brondby.com'],
            //            ['name' => 'Spiller BK Union', 'email' => 'spiller68@brondby.com'],
            //            ['name' => 'Spiller BK Union', 'email' => 'spiller69@brondby.com'],
            //            ['name' => 'Spiller BK Union', 'email' => 'spiller70@brondby.com'],
            //
            //            ['name' => 'Agent', 'email' => 'agent@brondby.com'],
            //            ['name' => 'Agent', 'email' => 'agent2@brondby.com'],
            ['name' => 'Træner U6', 'email' => 'coachU6@brondby.com', 'age_group_id' => 1, 'role' => 'coach'],
            ['name' => 'Træner U7', 'email' => 'coachU7@brondby.com', 'age_group_id' => 2, 'role' => 'coach'],
            ['name' => 'Træner U8', 'email' => 'coachU8@brondby.com', 'age_group_id' => 3, 'role' => 'coach'],
            ['name' => 'Træner U9', 'email' => 'coachU9@brondby.com', 'age_group_id' => 4, 'role' => 'coach'],
            ['name' => 'Træner U10', 'email' => 'coachU10@brondby.com', 'age_group_id' => 5, 'role' => 'coach'],
            ['name' => 'Træner U11', 'email' => 'coachU11@brondby.com', 'age_group_id' => 6, 'role' => 'coach'],
            ['name' => 'Træner U12', 'email' => 'coachU12@brondby.com', 'age_group_id' => 7, 'role' => 'coach'],
            ['name' => 'Træner U13', 'email' => 'coachU13@brondby.com', 'age_group_id' => 8, 'role' => 'coach'],
        ];
        foreach ($users as $user) {
            $userData = [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('masterclass'),
            ];
            if (array_key_exists('club_id', $user)) {
                $userData['club_id'] = $user['club_id'];
            }
            if (array_key_exists('age_group_id', $user)) {
                $userData['age_group_id'] = $user['age_group_id'];
            }
            $userData['approved_at'] = now();
            $userData['created_at'] = now();
            $userData['updated_at'] = now();

            DB::table('users')->insert($userData);

            if (isset($user['role'])) {
                $newUser = User::where('email', $user['email'])->first();
                $newUser->assignRole($user['role']);
            }

        }

        // Age Groups
        $i = 6;
        while ($i <= 19) {
            $ageGroup = new AgeGroup;
            $ageGroup->name = 'U'.$i;
            $ageGroup->age = $i;
            $ageGroup->save();
            $i++;
        }

        // Clubs
        $clubs = [
            ['name' => 'Brøndbyernes IF', 'website' => 'https://www.brondbyif.net/'],
            ['name' => 'AB Tårnby', 'website' => 'https://www.abtaarnby.dk/'],
            ['name' => 'AIK Strøby', 'website' => 'https://1251-aik-65-stroeby-fodbold.euwest01.umbraco.io/'],
            ['name' => 'Albertslund IF', 'website' => 'https://www.aif-fodbold.dk/'],
            ['name' => 'Ballerup-Skovlunde Fodbold', 'website' => 'https://bsfodbold.dk/'],
            ['name' => 'BK Avarta', 'website' => 'https://www.avarta.dk/'],
            ['name' => 'BK FREM', 'website' => 'https://bkfrem.dk/'],
            ['name' => 'BK Friheden', 'website' => 'http://bkfriheden.dk/'],
            ['name' => 'BK Rødovre', 'website' => 'https://www.bkrodovre.dk/'],
            ['name' => 'BK Union', 'website' => 'https://www.bkunion.dk/'],
            ['name' => 'Brøndby Strand IK', 'website' => 'https://bsifodbold.dk/'],
            ['name' => 'BS72', 'website' => 'https://www.bs72.dk/'],
            ['name' => 'Ejby IF68', 'website' => 'https://live-1002-ejby-if-1968.umbraco-proxy.com/'],
            ['name' => 'FK Sydsjælland 05', 'website' => 'https://live-1750-fk-sydsjaelland-05.umbraco-proxy.com/'],
            ['name' => 'Fløng-Hedehusene Fodbold', 'website' => 'https://www.fhfodbold.dk/'],
            ['name' => 'Glostrup FK', 'website' => 'https://www.glostrupfodbold.dk/'],
            ['name' => 'Haslev FC', 'website' => 'https://www.haslev-fc.dk/'],
            ['name' => 'Herstedøster IC', 'website' => 'https://www.hic.dk/'],
            ['name' => 'Hundige BK', 'website' => 'https://www.hundigeboldklub.dk/'],
            ['name' => 'Ishøj IF', 'website' => 'https://www.ishojif.dk/'],
            ['name' => 'Jyllinge FC', 'website' => 'https://www.jyllinge-fc.dk/'],
            ['name' => 'LB07', 'website' => 'https://lb07.se/'],
            ['name' => 'Måløv BK', 'website' => 'https://www.mb-boldklub.dk/'],
            ['name' => 'Orient Fodbold', 'website' => 'https://www.orientexpressen.dk/'],
            ['name' => 'Ølstykke FC', 'website' => 'https://live-1322-oelstykke-fc.umbraco-proxy.com/'],
            ['name' => 'Ringsted IF', 'website' => 'https://rif-fodbold.dk/'],
            ['name' => 'Sengeløse GIF', 'website' => 'https://sengeloese.dk/fodbold/'],
            ['name' => 'Solrød FC', 'website' => 'https://www.solrodfc.dk/'],
            ['name' => 'Stenløse BK', 'website' => 'https://www.stenloese-bk.dk/'],
            ['name' => 'Suså IF', 'website' => 'https://www.susaaif.dk/'],
            ['name' => 'Svogerslev BK', 'website' => 'https://www.svogerslev-bk.dk/'],
            ['name' => 'Taastrup FC', 'website' => 'https://www.taastrupfc.com/'],
            ['name' => 'Tårnby FF', 'website' => 'https://www.taarnbyff.dk/'],
            ['name' => 'Team A/S SBG&I', 'website' => 'https://www.sbgi.dk/'],
            ['name' => 'Vallensbæk IF', 'website' => 'https://www.vallensbaek-if.dk/'],
            ['name' => 'Vestegnens Bold Akademi', 'website' => 'https://www.vestegnensboldakademi.dk/'],
            ['name' => 'Vordingborg IF', 'website' => 'https://www.vifnet.dk/'],
        ];
        foreach ($clubs as $clubData) {
            $club = new Club;
            $club->fill($clubData);
            $club->save();
        }
        //Teams med relation til age_group og club
        //        $teams = [
        //            //Brøndbyernes IF
        //            ['club_id' => 1, 'age_group_id' => 1],
        //            ['club_id' => 1, 'age_group_id' => 2],
        //            ['club_id' => 1, 'age_group_id' => 3],
        //            ['club_id' => 1, 'age_group_id' => 4],
        //            ['club_id' => 1, 'age_group_id' => 5],
        //            ['club_id' => 1, 'age_group_id' => 6],
        //            ['club_id' => 1, 'age_group_id' => 7],
        //            //AB Tårnby
        //            ['club_id' => 2, 'age_group_id' => 1],
        //            ['club_id' => 2, 'age_group_id' => 2],
        //            ['club_id' => 2, 'age_group_id' => 3],
        //            ['club_id' => 2, 'age_group_id' => 4],
        //            ['club_id' => 2, 'age_group_id' => 5],
        //            ['club_id' => 2, 'age_group_id' => 6],
        //            ['club_id' => 2, 'age_group_id' => 7],
        //            //AIK Strøby
        //            ['club_id' => 3, 'age_group_id' => 1],
        //            ['club_id' => 3, 'age_group_id' => 2],
        //            ['club_id' => 3, 'age_group_id' => 3],
        //            ['club_id' => 3, 'age_group_id' => 4],
        //            ['club_id' => 3, 'age_group_id' => 5],
        //            ['club_id' => 3, 'age_group_id' => 6],
        //            ['club_id' => 3, 'age_group_id' => 7],
        //            //Albertslund IF
        //            ['club_id' => 4, 'age_group_id' => 1],
        //            ['club_id' => 4, 'age_group_id' => 2],
        //            ['club_id' => 4, 'age_group_id' => 3],
        //            ['club_id' => 4, 'age_group_id' => 4],
        //            ['club_id' => 4, 'age_group_id' => 5],
        //            ['club_id' => 4, 'age_group_id' => 6],
        //            ['club_id' => 4, 'age_group_id' => 7],
        //            //Ballerup-Skovlunde
        //            ['club_id' => 5, 'age_group_id' => 1],
        //            ['club_id' => 5, 'age_group_id' => 2],
        //            ['club_id' => 5, 'age_group_id' => 3],
        //            ['club_id' => 5, 'age_group_id' => 4],
        //            ['club_id' => 5, 'age_group_id' => 5],
        //            ['club_id' => 5, 'age_group_id' => 6],
        //            ['club_id' => 5, 'age_group_id' => 7],
        //            //BK Avarta
        //            ['club_id' => 6, 'age_group_id' => 1],
        //            ['club_id' => 6, 'age_group_id' => 2],
        //            ['club_id' => 6, 'age_group_id' => 3],
        //            ['club_id' => 6, 'age_group_id' => 4],
        //            ['club_id' => 6, 'age_group_id' => 5],
        //            ['club_id' => 6, 'age_group_id' => 6],
        //            ['club_id' => 6, 'age_group_id' => 7],
        //            //BK FREM
        //            ['club_id' => 7, 'age_group_id' => 1],
        //            ['club_id' => 7, 'age_group_id' => 2],
        //            ['club_id' => 7, 'age_group_id' => 3],
        //            ['club_id' => 7, 'age_group_id' => 4],
        //            ['club_id' => 7, 'age_group_id' => 5],
        //            ['club_id' => 7, 'age_group_id' => 6],
        //            ['club_id' => 7, 'age_group_id' => 7],
        //            //BK Friheden
        //            ['club_id' => 8, 'age_group_id' => 1],
        //            ['club_id' => 8, 'age_group_id' => 2],
        //            ['club_id' => 8, 'age_group_id' => 3],
        //            ['club_id' => 8, 'age_group_id' => 4],
        //            ['club_id' => 8, 'age_group_id' => 5],
        //            ['club_id' => 8, 'age_group_id' => 6],
        //            ['club_id' => 8, 'age_group_id' => 7],
        //            //BK Rødovre
        //            ['club_id' => 9, 'age_group_id' => 1],
        //            ['club_id' => 9, 'age_group_id' => 2],
        //            ['club_id' => 9, 'age_group_id' => 3],
        //            ['club_id' => 9, 'age_group_id' => 4],
        //            ['club_id' => 9, 'age_group_id' => 5],
        //            ['club_id' => 9, 'age_group_id' => 6],
        //            ['club_id' => 9, 'age_group_id' => 7],
        //            //BK Union
        //            ['club_id' => 10, 'age_group_id' => 1],
        //            ['club_id' => 10, 'age_group_id' => 2],
        //            ['club_id' => 10, 'age_group_id' => 3],
        //            ['club_id' => 10, 'age_group_id' => 4],
        //            ['club_id' => 10, 'age_group_id' => 5],
        //            ['club_id' => 10, 'age_group_id' => 6],
        //            ['club_id' => 10, 'age_group_id' => 7],
        //        ];
        //
        //        Team::insert($teams);

        // Tags
        $tags = [
            ['type' => 'technical', 'name' => '1.berøring/Sparkeformer'],
            ['type' => 'technical', 'name' => 'Fodboldkoordination'],
            ['type' => 'technical', 'name' => 'Cuts/Vendinger'],
            ['type' => 'technical', 'name' => 'Driblinger/Finter'],
            ['type' => 'physical', 'name' => 'Gymnastik/Sjipning'],
            ['type' => 'physical', 'name' => 'Motorik og kropskontrol'],
            ['type' => 'physical', 'name' => 'Agility'],
            ['type' => 'physical', 'name' => 'Life Kinetik'],
            ['type' => 'mental', 'name' => 'Glæde'],
            ['type' => 'mental', 'name' => 'Ejerskab'],
            ['type' => 'mental', 'name' => 'Mod'],
            ['type' => 'mental', 'name' => 'Trænings/læringsparat'],
            ['type' => 'tactical', 'name' => 'Spil forbi noget'],
            ['type' => 'tactical', 'name' => 'Tænk fremad for retvendt spiller'],
            ['type' => 'tactical', 'name' => 'Etablere pres'],
            ['type' => 'tactical', 'name' => 'Tæt på presspiller'],
            ['type' => 'tactical', 'name' => 'Find en åben dør'],
            //            ['type'=>'matching', 'name'=> 'NUF'],
            //            ['type'=>'matching', 'name'=> 'FYS'],
            //            ['type'=>'matching', 'name'=> 'FOA'],
            //            ['type'=>'matching', 'name'=> 'REA'],
            //            ['type'=>'matching', 'name'=> 'KAN/VIL'],
        ];

        foreach ($tags as $tag) {
            $newTag = Tag::create([
                'name' => $tag['name'],
                'type' => $tag['type'],
            ]);
        }
        // Equipment
        $equipmentData = json_decode(File::get(database_path('data/equipment.json')), true);
        $equipment = [];
        foreach ($equipmentData as $item) {
            unset($item['id']);
            $equipment[] = Equipment::create($item);
        }
        //Guides
//        $guideData = json_decode(File::get(database_path('data/guides.json')), true);
//        $guides = [];
//        foreach ($guideData as $item) {
//            unset($item['id']);
//            $guides[] = Guide::create($item);
//        }
        // Exercises
        $exerciseData = json_decode(File::get(database_path('data/exercises.json')), true);
        $exercises = [];
        foreach ($exerciseData as $item) {
            unset($item['id']);
            $id = DB::table('exercises')->insertGetId($item);
            $exercise = Exercise::find($id);
            $exercises[] = $exercise;
            $exerciseType = $exercise->exercise_type;
            $filteredEquipment = array_filter($equipment, function ($eq) use ($exerciseType) {
                return $eq->type === $exerciseType;
            });
            $randomEquipment = Arr::random($filteredEquipment, rand(1, 3));
            foreach ($randomEquipment as $equipmentSingle) {
                $exercise->equipment()->attach($equipmentSingle->id, ['quantity' => rand(2, 8)]);
            }
            $randomTag = Tag::inRandomOrder()->limit(rand(1, 3))->get();
            $exercise->attachTags($randomTag);
        }

        // Player Positions
        $positions = ['Målmand', 'Forsvarsspiller', 'Midtbane', 'Angriber'];
        foreach ($positions as $position) {
            $playerPosition = new PlayerPosition;
            $playerPosition->name = $position;
            $playerPosition->save();
        }


        // Training plan
        $trainingplans = [
            ['name' => 'Periodisering 1. halvår', 'type' => 'football', 'age_group_id' => 1],
            ['name' => 'Periodisering 1. halvår', 'type' => 'football', 'age_group_id' => 2],
            ['name' => 'Periodisering 1. halvår', 'type' => 'football', 'age_group_id' => 3],
            ['name' => 'Periodisering 1. halvår', 'type' => 'football', 'age_group_id' => 4],
            ['name' => 'Periodisering 1. halvår', 'type' => 'football', 'age_group_id' => 5],
            ['name' => 'Periodisering 1. halvår', 'type' => 'football', 'age_group_id' => 6],
            ['name' => 'Periodisering 1. halvår', 'type' => 'football', 'age_group_id' => 7],

            //            ['name' => 'Periodisering AB Tårnby 1. halvår', 'type' => 'football', 'team_id' => 8],
            //            ['name' => 'Periodisering AB Tårnby 1. halvår', 'type' => 'football', 'team_id' => 9],
            //            ['name' => 'Periodisering AB Tårnby 1. halvår', 'type' => 'football', 'team_id' => 10],
            //            ['name' => 'Periodisering AB Tårnby 1. halvår', 'type' => 'football', 'team_id' => 11],
            //            ['name' => 'Periodisering AB Tårnby 1. halvår', 'type' => 'football', 'team_id' => 12],
            //            ['name' => 'Periodisering AB Tårnby 1. halvår', 'type' => 'football', 'team_id' => 13],
            //            ['name' => 'Periodisering AB Tårnby 1. halvår', 'type' => 'football', 'team_id' => 14],
            //
            //            ['name' => 'Periodisering AIK Strøby 1. halvår', 'type' => 'football', 'team_id' => 15],
            //            ['name' => 'Periodisering AIK Strøby 1. halvår', 'type' => 'football', 'team_id' => 16],
            //            ['name' => 'Periodisering AIK Strøby 1. halvår', 'type' => 'football', 'team_id' => 17],
            //            ['name' => 'Periodisering AIK Strøby 1. halvår', 'type' => 'football', 'team_id' => 18],
            //            ['name' => 'Periodisering AIK Strøby 1. halvår', 'type' => 'football', 'team_id' => 19],
            //            ['name' => 'Periodisering AIK Strøby 1. halvår', 'type' => 'football', 'team_id' => 20],
            //            ['name' => 'Periodisering AIK Strøby 1. halvår', 'type' => 'football', 'team_id' => 21],
            //
            //            ['name' => 'Periodisering Albertslund IF 1. halvår', 'type' => 'football', 'team_id' => 22],
            //            ['name' => 'Periodisering Albertslund IF 1. halvår', 'type' => 'football', 'team_id' => 23],
            //            ['name' => 'Periodisering Albertslund IF 1. halvår', 'type' => 'football', 'team_id' => 24],
            //            ['name' => 'Periodisering Albertslund IF 1. halvår', 'type' => 'football', 'team_id' => 25],
            //            ['name' => 'Periodisering Albertslund IF 1. halvår', 'type' => 'football', 'team_id' => 26],
            //            ['name' => 'Periodisering Albertslund IF 1. halvår', 'type' => 'football', 'team_id' => 27],
            //            ['name' => 'Periodisering Albertslund IF 1. halvår', 'type' => 'football', 'team_id' => 28],
            //
            //            ['name' => 'Periodisering Ballerup-Skovlunde 1. halvår', 'type' => 'football', 'team_id' => 29],
            //            ['name' => 'Periodisering Ballerup-Skovlunde 1. halvår', 'type' => 'football', 'team_id' => 30],
            //            ['name' => 'Periodisering Ballerup-Skovlunde 1. halvår', 'type' => 'football', 'team_id' => 31],
            //            ['name' => 'Periodisering Ballerup-Skovlunde 1. halvår', 'type' => 'football', 'team_id' => 32],
            //            ['name' => 'Periodisering Ballerup-Skovlunde 1. halvår', 'type' => 'football', 'team_id' => 33],
            //            ['name' => 'Periodisering Ballerup-Skovlunde 1. halvår', 'type' => 'football', 'team_id' => 34],
            //            ['name' => 'Periodisering Ballerup-Skovlunde 1. halvår', 'type' => 'football', 'team_id' => 35],
            //
            //            ['name' => 'Periodisering BK Avarta 1. halvår', 'type' => 'football', 'team_id' => 36],
            //            ['name' => 'Periodisering BK Avarta 1. halvår', 'type' => 'football', 'team_id' => 37],
            //            ['name' => 'Periodisering BK Avarta 1. halvår', 'type' => 'football', 'team_id' => 38],
            //            ['name' => 'Periodisering BK Avarta 1. halvår', 'type' => 'football', 'team_id' => 39],
            //            ['name' => 'Periodisering BK Avarta 1. halvår', 'type' => 'football', 'team_id' => 40],
            //            ['name' => 'Periodisering BK Avarta 1. halvår', 'type' => 'football', 'team_id' => 41],
            //            ['name' => 'Periodisering BK Avarta 1. halvår', 'type' => 'football', 'team_id' => 42],
            //
            //            ['name' => 'Periodisering BK FREM 1. halvår', 'type' => 'football', 'team_id' => 43],
            //            ['name' => 'Periodisering BK FREM 1. halvår', 'type' => 'football', 'team_id' => 44],
            //            ['name' => 'Periodisering BK FREM 1. halvår', 'type' => 'football', 'team_id' => 45],
            //            ['name' => 'Periodisering BK FREM 1. halvår', 'type' => 'football', 'team_id' => 46],
            //            ['name' => 'Periodisering BK FREM 1. halvår', 'type' => 'football', 'team_id' => 47],
            //            ['name' => 'Periodisering BK FREM 1. halvår', 'type' => 'football', 'team_id' => 48],
            //            ['name' => 'Periodisering BK FREM 1. halvår', 'type' => 'football', 'team_id' => 49],
            //
            //            ['name' => 'Periodisering BK Friheden 1. halvår', 'type' => 'football', 'team_id' => 50],
            //            ['name' => 'Periodisering BK Friheden 1. halvår', 'type' => 'football', 'team_id' => 51],
            //            ['name' => 'Periodisering BK Friheden 1. halvår', 'type' => 'football', 'team_id' => 52],
            //            ['name' => 'Periodisering BK Friheden 1. halvår', 'type' => 'football', 'team_id' => 53],
            //            ['name' => 'Periodisering BK Friheden 1. halvår', 'type' => 'football', 'team_id' => 54],
            //            ['name' => 'Periodisering BK Friheden 1. halvår', 'type' => 'football', 'team_id' => 55],
            //            ['name' => 'Periodisering BK Friheden 1. halvår', 'type' => 'football', 'team_id' => 56],
            //
            //            ['name' => 'Periodisering BK Rødovre 1. halvår', 'type' => 'football', 'team_id' => 57],
            //            ['name' => 'Periodisering BK Rødovre 1. halvår', 'type' => 'football', 'team_id' => 58],
            //            ['name' => 'Periodisering BK Rødovre 1. halvår', 'type' => 'football', 'team_id' => 59],
            //            ['name' => 'Periodisering BK Rødovre 1. halvår', 'type' => 'football', 'team_id' => 60],
            //            ['name' => 'Periodisering BK Rødovre 1. halvår', 'type' => 'football', 'team_id' => 61],
            //            ['name' => 'Periodisering BK Rødovre 1. halvår', 'type' => 'football', 'team_id' => 62],
            //            ['name' => 'Periodisering BK Rødovre 1. halvår', 'type' => 'football', 'team_id' => 63],
            //
            //            ['name' => 'Periodisering BK Union 1. halvår', 'type' => 'football', 'team_id' => 64],
            //            ['name' => 'Periodisering BK Union 1. halvår', 'type' => 'football', 'team_id' => 65],
            //            ['name' => 'Periodisering BK Union 1. halvår', 'type' => 'football', 'team_id' => 66],
            //            ['name' => 'Periodisering BK Union 1. halvår', 'type' => 'football', 'team_id' => 67],
            //            ['name' => 'Periodisering BK Union 1. halvår', 'type' => 'football', 'team_id' => 68],
            //            ['name' => 'Periodisering BK Union 1. halvår', 'type' => 'football', 'team_id' => 69],
            //            ['name' => 'Periodisering BK Union 1. halvår', 'type' => 'football', 'team_id' => 70],
        ];
        foreach ($trainingplans as $trainingplan) {
            TrainingPlan::create($trainingplan);
        }

        // Session Group with relation to training plans
        $sessionGroups = [];
        $sessionGroupsTemplate = [
            ['starts_at' => '2024-01-15', 'ends_at' => '2024-01-28', 'name' => 'Opbygningsspil'],
            ['starts_at' => '2024-01-29', 'ends_at' => '2024-02-11', 'name' => 'Forsvars- og erobringsspil'],
            ['starts_at' => '2024-02-26', 'ends_at' => '2024-03-10', 'name' => 'Omstilling De – Vi'],
            ['starts_at' => '2024-03-11', 'ends_at' => '2024-03-24', 'name' => 'Gennembrudspil'],
            ['starts_at' => '2024-03-25', 'ends_at' => '2024-04-07', 'name' => 'Omstilling Vi – De'],
            ['starts_at' => '2024-04-08', 'ends_at' => '2024-04-21', 'name' => 'Opbygningsspil'],
            ['starts_at' => '2024-04-22', 'ends_at' => '2024-05-05', 'name' => 'Forsvars- og erobringsspil'],
            ['starts_at' => '2024-05-06', 'ends_at' => '2024-05-20', 'name' => 'Omstilling De – Vi'],
            ['starts_at' => '2024-05-21', 'ends_at' => '2024-06-02', 'name' => 'Gennembrudspil'],
            ['starts_at' => '2024-06-03', 'ends_at' => '2024-06-16', 'name' => 'Afslutningsspil'],

        ];
        for ($i = 1; $i <= 7; $i++) {
            foreach ($sessionGroupsTemplate as $template) {
                $sessionGroups[] = array_merge(['training_plan_id' => $i], $template);
            }
        }
        foreach ($sessionGroups as $sessionGroup) {
            SessionGroup::create($sessionGroup);
        }

        // TrainingSession with relation to sessionGroups
        $trainingSessions = [];

        for ($i = 1; $i <= 70; $i++) {
            $name = 'En træning';
            $trainingSessions[] = [
                'session_group_id' => $i,
                'name' => $name,
                'slug' => Str::slug($name.' '.$i),
            ];
        }

        TrainingSession::insert($trainingSessions);
        $latestSessions = TrainingSession::orderBy('id', 'desc')->take(70)->get();
        $sessionIds = $latestSessions->pluck('id')->toArray();
        $footballExercises = array_filter($exercises, function ($exercise) {
            return $exercise->exercise_type === 'football';
        });
        $exercisePivotData = [];
        foreach ($sessionIds as $sessionId) {
            $randomExercises = Arr::random($footballExercises, rand(3, 5));
            foreach ($randomExercises as $exercise) {
                $exercisePivotData[] = [
                    'training_session_id' => $sessionId,
                    'exercise_id' => $exercise->id,
                    'duration' => Arr::random([10, 15, 20, 25]),
                ];
            }
        }
        DB::table('exercise_training_session')->insert($exercisePivotData);

        //Spillere med relation til en user og et hold
        //        $players = [
        //            //Brøndbyernes IF
        //            ['user_id' => 10, 'team_id' => 1],
        //            ['user_id' => 11, 'team_id' => 2],
        //            ['user_id' => 12, 'team_id' => 3],
        //            ['user_id' => 13, 'team_id' => 4],
        //            ['user_id' => 14, 'team_id' => 5],
        //            ['user_id' => 15, 'team_id' => 6],
        //            ['user_id' => 16, 'team_id' => 7],
        //            //AB Tårnby
        //            ['user_id' => 17, 'team_id' => 8],
        //            ['user_id' => 18, 'team_id' => 9],
        //            ['user_id' => 19, 'team_id' => 10],
        //            ['user_id' => 20, 'team_id' => 11],
        //            ['user_id' => 21, 'team_id' => 12],
        //            ['user_id' => 22, 'team_id' => 13],
        //            ['user_id' => 23, 'team_id' => 14],
        //            //AIK Strøby
        //            ['user_id' => 24, 'team_id' => 15],
        //            ['user_id' => 25, 'team_id' => 16],
        //            ['user_id' => 26, 'team_id' => 17],
        //            ['user_id' => 27, 'team_id' => 18],
        //            ['user_id' => 28, 'team_id' => 19],
        //            ['user_id' => 29, 'team_id' => 20],
        //            ['user_id' => 30, 'team_id' => 21],
        //            //Albertslund IF
        //            ['user_id' => 31, 'team_id' => 22],
        //            ['user_id' => 32, 'team_id' => 23],
        //            ['user_id' => 33, 'team_id' => 24],
        //            ['user_id' => 34, 'team_id' => 25],
        //            ['user_id' => 35, 'team_id' => 26],
        //            ['user_id' => 36, 'team_id' => 27],
        //            ['user_id' => 37, 'team_id' => 28],
        //            //Ballerup-Skovlunde
        //            ['user_id' => 38, 'team_id' => 29],
        //            ['user_id' => 39, 'team_id' => 30],
        //            ['user_id' => 40, 'team_id' => 31],
        //            ['user_id' => 41, 'team_id' => 32],
        //            ['user_id' => 42, 'team_id' => 33],
        //            ['user_id' => 43, 'team_id' => 34],
        //            ['user_id' => 44, 'team_id' => 35],
        //            //BK Avarta
        //            ['user_id' => 45, 'team_id' => 36],
        //            ['user_id' => 46, 'team_id' => 37],
        //            ['user_id' => 47, 'team_id' => 38],
        //            ['user_id' => 48, 'team_id' => 39],
        //            ['user_id' => 49, 'team_id' => 40],
        //            ['user_id' => 50, 'team_id' => 41],
        //            ['user_id' => 51, 'team_id' => 42],
        //            //BK FREM
        //            ['user_id' => 52, 'team_id' => 43],
        //            ['user_id' => 53, 'team_id' => 44],
        //            ['user_id' => 54, 'team_id' => 45],
        //            ['user_id' => 55, 'team_id' => 46],
        //            ['user_id' => 56, 'team_id' => 47],
        //            ['user_id' => 57, 'team_id' => 48],
        //            ['user_id' => 58, 'team_id' => 49],
        //            //BK Friheden
        //            ['user_id' => 59, 'team_id' => 50],
        //            ['user_id' => 60, 'team_id' => 51],
        //            ['user_id' => 61, 'team_id' => 52],
        //            ['user_id' => 62, 'team_id' => 53],
        //            ['user_id' => 63, 'team_id' => 54],
        //            ['user_id' => 64, 'team_id' => 55],
        //            ['user_id' => 65, 'team_id' => 56],
        //            //BK Rødovre
        //            ['user_id' => 66, 'team_id' => 57],
        //            ['user_id' => 67, 'team_id' => 58],
        //            ['user_id' => 68, 'team_id' => 59],
        //            ['user_id' => 69, 'team_id' => 60],
        //            ['user_id' => 70, 'team_id' => 61],
        //            ['user_id' => 71, 'team_id' => 62],
        //            ['user_id' => 72, 'team_id' => 63],
        //            //BK Union
        //            ['user_id'=>73, 'team_id'=>64],
        //            ['user_id'=>74, 'team_id'=>65],
        //            ['user_id'=>75, 'team_id'=>66],
        //            ['user_id'=>76, 'team_id'=>67],
        //            ['user_id'=>77, 'team_id'=>68],
        //            ['user_id'=>78, 'team_id'=>69],
        //            ['user_id'=>79, 'team_id'=>70],
        //        ];
        //        Player::insert($players);

        $categories = [
            ['name' => 'Bevægelse Træning', 'category_group_id' => 1],
            ['name' => 'Agility Øvelser og Spil', 'category_group_id' => 1, 'category_id' => 1],
            ['name' => 'Bevægelse og Motorik', 'category_group_id' => 2, 'category_id' => 1],
            ['name' => 'Fodboldkoordination', 'category_group_id' => 1, 'category_id' => 1],
            ['name' => 'Footwork', 'category_group_id' => 1, 'category_id' => 1],

            ['name' => 'Small Sided Games', 'category_group_id' => 1],
            ['name' => '1v1', 'category_group_id' => 1, 'category_id' => 6],
            ['name' => '1v2', 'category_group_id' => 1, 'category_id' => 6],
            ['name' => '2v1', 'category_group_id' => 1, 'category_id' => 6],
            ['name' => '2v2', 'category_group_id' => 1, 'category_id' => 6],
            ['name' => '3v2', 'category_group_id' => 1, 'category_id' => 6],
            ['name' => 'Shortgame', 'category_group_id' => 1, 'category_id' => 6],

            ['name' => 'Driblinger og Finter', 'category_group_id' => 1],
            ['name' => 'Cuts/Vendinger', 'category_group_id' => 1],
            ['name' => 'Pasninger, 1. Berøringer og vendinger', 'category_group_id' => 1],
            ['name' => 'Afslutninger', 'category_group_id' => 1],
            ['name' => 'Rondos', 'category_group_id' => 1],
            ['name' => 'Positionsspil', 'category_group_id' => 1],
            ['name' => 'Fodboldlege', 'category_group_id' => 1],
            ['name' => 'Core 1', 'category_group_id' => 2],
            ['name' => 'Core 2', 'category_group_id' => 2],
            ['name' => 'Skadesforebyggende Træning', 'category_group_id' => 2],
        ];

        $fitnessExercises = array_filter($exerciseData, function ($exercise) {
            return $exercise['exercise_type'] === 'fitness';
        });
        $footballExercises = array_filter($exerciseData, function ($exercise) {
            return $exercise['exercise_type'] === 'football';
        });
        foreach ($categories as $category) {
            if (isset($category['category_id']) && $category['category_id'] != null) {
                $newCategory = Category::create([
                    'name' => $category['name'],
                    'category_group_id' => $category['category_group_id'],
                    'category_id' => $category['category_id'],
                ]);
            } else {
                $newCategory = Category::create([
                    'name' => $category['name'],
                    'category_group_id' => $category['category_group_id'],
                ]);
            }
            $filteredExercises = $newCategory['category_group_id'] == 1 ? $footballExercises : $fitnessExercises;

            if (count($filteredExercises) > 0) {
                $randomExercises = array_rand($filteredExercises, min(5, count($filteredExercises)));
                foreach ($randomExercises as $randomExercise) {
                    $exerciseModel = Exercise::find($randomExercise);
                    if ($exerciseModel) {
                        $exerciseModel->categories()->attach($newCategory->id);
                    }
                }
            }
        }
    }
}
