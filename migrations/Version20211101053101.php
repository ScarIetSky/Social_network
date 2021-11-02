<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211101053101 extends AbstractMigration
{
    private array $names = [
        'Olivia',
        'Emma',
        'Ava',
        'Charlotte',
        'Sophia',
        'Amelia',
        'Isabella',
        'Mia',
        'Evelyn',
        'Harper',
        'Camila',
        'Gianna',
        'Abigail',
        'Luna',
        'Ella',
        'Elizabeth',
        'Sofia',
        'Emily',
        'Avery',
        'Mila',
        'Scarlett',
        'Eleanor',
        'Madison',
        'Layla',
        'Penelope',
        'Aria',
        'Chloe',
        'Grace',
        'Ellie',
        'Nora',
        'Hazel',
        'Zoey',
        'Riley',
        'Victoria',
        'Lily',
        'Aurora',
        'Violet',
        'Nova',
        'Hannah',
        'Emilia',
        'Zoe',
        'Stella',
        'Everly',
        'Isla',
        'Leah',
        'Lillian',
        'Addison',
        'Willow',
        'Lucy',
        'Paisley',
        'Natalie',
        'Naomi',
        'Eliana',
        'Brooklyn',
        'Elena',
        'Aubrey',
        'Claire',
        'Ivy',
        'Kinsley',
        'Bella',
    ];

    private array $surnames = [
        'Harley',
        'Cali',
        'Maggie',
        'Hayden',
        'Leia',
        'Fiona',
        'Briella',
        'Journey',
        'Lennon',
        'Saylor',
        'Jayla',
        'Kaia',
        'Thea',
        'Adriana',
        'Mariah',
        'Juliet',
        'Oaklynn',
        'Kiara',
        'Alexis',
        'Haven',
        'Aniyah',
        'Delaney',
        'Gracelynn',
        'Kendall',
        'Winter',
        'Lilith',
        'Logan',
        'Amiyah',
        'Evie',
        'Alexandria',
        'Gracelyn',
        'Gabriela',
        'Sutton',
        'Harlow',
        'Madilyn',
        'Makayla',
        'Evelynn',
        'Gia',
        'Nina',
        'Amina',
        'Giselle',
        'Brynn',
        'Blair',
        'Amari',
        'Octavia',
        'Michelle',
        'Talia',
        'Demi',
        'Alaya',
        'Kaylani',
        'Izabella',
        'Fatima',
        'Tatum',
        'Makenzie',
        'Lilliana',
        'Arielle',
        'Palmer',
        'Melissa',
        'Willa',
        'Samara',
        'Destiny',
        'Dahlia',
        'Celeste',
        'Ainsley',
        'Rylie',
        'Reign',
        'Laura',
        'Adelynn',
        'Gabrielle',
        'Remington',
        'Wren',
        'Brinley',
        'Amora',
        'Lainey',
        'Collins',
        'Lexi',
        'Aitana',
        'Alessandra',
        'Kenzie',
        'Raelyn',
        'Elle',
        'Everlee',
        'Haisley',
        'Hallie',
        'Wynter',
        'Daleyza',
        'Gwendolyn',
        'Paislee',
        'Ariyah',
        'Veronica',
        'Heidi',
        'Anaya',
        'Cataleya',
        'Kira',
        'Avianna',
        'Felicity',
        'Aylin',
        'Miracle',
        'Sabrina',
        'Lana',
        'Ophelia',
        'Elianna',
        'Royalty',
        'Madeleine',
        'Esmeralda',
        'Joy',
        'Kalani',
        'Esme',
        'Jessica',
        'Leighton',
        'Ariah',
        'Makenna',
        'Nylah',
        'Viviana',
        'Camryn',
        'Cassidy',
        'Dream',
        'Luciana',
        'Maisie',
        'Stevie',
        'Kate',
        'Lyric',
        'Daniella',
        'Alicia',
        'Daphne',
        'Frances',
        'Charli',
        'Raven',
        'Paris',
        'Nayeli',
        'Serena',
        'Heaven',
        'Bianca',
        'Helen',
        'Hattie',
        'Averie',
        'Mabel',
        'Selah',
        'Allie',
        'Marlee',
        'Kinley',
        'Regina',
        'Carmen',
        'Jennifer',
        'Jordan',
        'Alison',
        'Stephanie',
        'Maren',
        'Kayleigh',
        'Angel',
        'Annalise',
        'Jacqueline',
        'Braelynn',
        'Emory',
        'Rosemary',
        'Scarlet',
        'Amanda',
        'Danielle',
        'Emelia',
        'Ryan',
        'Carolina',
        'Astrid',
        'Kensley',
        'Shiloh',
        'Maci',
        'Francesca',
        'Rory',
        'Celine',
        'Kamryn',
        'Zariah',
        'Liana',
        'Poppy',
        'Maliyah',
        'Keira',
        'Skyler',
        'Noa',
        'Skye',
        'Nadia',
        'Addilyn',
        'Rosie',
        'Eve',
        'Sarai',
        'Edith',
        'Jolene',
        'Maddison',
        'Meadow',
        'Charleigh',
        'Matilda',
        'Elliott',
        'Madelynn',
        'Holly',
        'Leona',
        'Azalea',
        'Katie',
        'Mira',
        'Ari',
        'Kaitlyn',
        'Danna',
        'Cameron',
        'Kyla',
        'Bristol',
        'Kora',
        'Armani',
        'Nia',
        'Malani',
        'Dylan',
        'Remy',
        'Maia',
        'Dior',
        'Legacy',
        'Alessia',
        'Shelby',
        'Maryam',
        'Sylvia',
        'Yaretzi',
        'Lorelei',
        'Madilynn',
        'Abby',
        'Helena',
        'Jimena',
        'Elisa',
        'Renata',
        'Amber',
        'Aviana',
        'Carter',
        'Emmy',
        'Haley',
        'Alondra',
        'Elaine',
        'Erin',
        'April',
        'Emely',
        'Imani',
        'Kennedi',
        'Lorelai',
        'Hanna',
        'Kelsey',
        'Aurelia',
        'Colette',
        'Jaliyah',
        'Kylee',
        'Macie',
        'Aisha',
        'Dorothy',
        'Charley',
        'Kathryn',
        'Adelina',
        'Adley',
        'Monroe',
        'Sierra',
        'Ailani',
        'Miranda',
        'Mikayla',
        'Alejandra',
        'Amirah',
        'Jada',
        'Jazlyn',
        'Jenna',
        'Jayleen',
        'Beatrice',
        'Kendra',
        'Lyra',
        'Nola',
        'Emberly',
        'Mckinley',
        'Myra',
        'Katalina',
        'Antonella',
        'Zelda',
        'Alanna',
        'Amaia',
        'Priscilla',
        'Briar',
        'Kaliyah',
        'Itzel',
        'Oaklyn',
        'Alma',
        'Mallory',
        'Novah',
        'Amalia',
        'Fernanda',
        'Alia',
        'Angelica',
        'Elliot',
        'Justice',
        'Mae',
        'Cecelia',
        'Gloria',
        'Ariya',
        'Virginia',
        'Cheyenne',
        'Aleah',
        'Jemma',
        'Henley',
        'Meredith',
        'Leyla',
        'Lennox',
        'Ensley',
        'Zahra',
        'Reina',
        'Frankie',
        'Lylah',
        'Nalani',
        'Reyna',
        'Saige',
        'Ivanna',
        'Aleena',
        'Emerie',
        'Ivory',
        'Leslie',
        'Alora',
        'Ashlyn',
        'Bethany',
        'Bonnie',
        'Sasha',
        'Xiomara',
        'Salem',
        'Adrianna',
        'Dayana',
        'Clementine',
        'Karina',
        'Karsyn',
        'Emmie',
        'Julie',
        'Julieta',
        'Briana',
        'Carly',
        'Macy',
        'Marie',
        'Oaklee',
        'Christina',
        'Malaysia',
        'Ellis',
        'Irene',
        'Anne',
        'Anahi',
        'Mara',
        'Rhea',
        'Davina',
        'Dallas',
        'Jayda',
        'Mariam',
        'Skyla',
        'Siena',
        'Elora',
        'Marilyn',
        'Jazmin',
        'Megan',
        'Rosa',
        'Savanna',
        'Allyson',
        'Milan',
        'Coraline',
        'Johanna',
        'Melany',
        'Chelsea',
        'Michaela',
        'Melina',
        'Angie',
        'Cassandra',
        'Yara',
        'Kassidy',
        'Liberty',
        'Lilian',
        'Avah',
        'Anya',
        'Laney',
        'Navy',
        'Opal',
        'Amani',
        'Zaylee',
        'Mina',
        'Sloan',
        'Romina',
        'Ashlynn',
        'Aliza',
        'Liv',
        'Malaya',
        'Blaire',
        'Janelle',
        'Kara',
        'Analia',
        'Hadassah',
        'Hayley',
        'Karla',
        'Chaya',
        'Cadence',
        'Kyra',
        'Alena',
        'Ellianna',
        'Katelyn',
        'Kimber',
        'Laurel',
        'Lina',
        'Capri',
        'Braelyn',
        'Faye',
        'Kamiyah',
        'Kenna',
        'Louise',
        'Calliope',
        'Kaydence',
        'Nala',
        'Tiana',
        'Aileen',
        'Sunny',
        'Zariyah',
        'Milana',
        'Giuliana',
        'Eileen',
        'Elodie',
        'Rayna',
        'Monica',
        'Galilea',
        'Journi',
        'Lara',
        'Marina',
        'Aliana',
        'Harmoni',
        'Jamie',
        'Holland',
        'Emmalyn',
        'Lauryn',
        'Chanel',
        'Tinsley',
        'Jessie',
        'Lacey',
        'Elyse',
        'Janiyah',
        'Jolie',
        'Ezra',
        'Marleigh',
        'Roselyn',
        'Lillie',
        'Louisa',
        'Madisyn',
        'Penny',
        'Kinslee',
        'Treasure',
        'Zaniyah',
        'Estella',
        'Jaylah',
        'Khaleesi',
        'Alexia',
        'Dulce',
        'Indie',
        'Maxine',
        'Waverly',
        'Giovanna',
        'Miley',
        'Saoirse',
        'Estrella',
        'Greta',
        'Rosalia',
        'Mylah',
        'Teresa',
        'Bridget',
        'Kelly',
        'Adalee',
        'Aubrie',
        'Lea',
        'Harlee',
        'Anika',
        'Itzayana',
        'Hana',
        'Kaisley',
        'Mikaela',
        'Naya',
        'Avalynn',
        'Margo',
        'Sevyn',
        'Florence',
        'Keilani',
        'Lyanna',
        'Joelle',
        'Kataleya',
        'Royal',
        'Averi',
        'Kallie',
        'Winnie',
        'Baylee',
        'Martha',
        'Pearl',
        'Alaiya',
        'Rayne',
        'Sylvie',
        'Brylee',
        'Jazmine',
        'Ryann',
        'Kori',
        'Noemi',
        'Haylee',
        'Julissa',
        'Celia',
        'Laylah',
        'Rebekah',
        'Rosalee',
        'Aya',
        'Bria',
        'Adele',
        'Aubrielle',
        'Tiffany',
        'Addyson',
        'Kai',
        'Bellamy',
        'Leilany',
        'Princess',
        'Chana',
        'Estelle',
        'Selene',
        'Sky',
        'Dani',
        'Thalia',
        'Ellen',
        'Rivka',
        'Amelie',
        'Andi',
        'Kynlee',
        'Raina',
        'Vienna',
        'Alianna',
        'Livia',
        'Madalyn',
        'Mercy',
        'Novalee',
        'Ramona',
        'Vada',
        'Berkley',
        'Gwen',
        'Persephone',
        'Milena',
        'Paula',
        'Clare',
        'Kairi',
        'Linda',
        'Paulina',
        'Kamilah',
        'Amoura',
        'Hunter',
        'Isabela',
        'Karen',
        'Marianna',
        'Sariyah',
        'Theodora',
        'Annika',
        'Kyleigh',
        'Nellie',
        'Scarlette',
        'Keyla',
        'Kailey',
        'Mavis',
        'Lilianna',
        'Rosalyn',
        'Sariah',
        'Tori',
        'Yareli',
        'Aubriella',
        'Bexley',
        'Bailee',
        'Jianna',
        'Keily',
        'Annabella',
        'Azariah',
        'Denisse',
        'Promise',
        'August',
        'Hadlee',
        'Halle',
        'Fallon',
        'Oakleigh',
        'Zaria',
        'Jaylin',
        'Paisleigh',
        'Crystal',
        'Ila',
        'Aliya',
        'Cynthia',
        'Giana',
        'Maleah',
        'Rylan',
        'Aniya',
        'Denise',
        'Emmeline',
        'Scout',
        'Simone',
        'Noah',
        'Zora',
        'Meghan',
        'Landry',
        'Ainhoa',
        'Lilyana',
        'Noor',
        'Belen',
        'Brynleigh',
        'Cleo',
        'Meilani',
        'Karter',
        'Amaris',
        'Frida',
        'Iliana',
        'Violeta',
        'Addisyn',
        'Nancy',
        'Denver',
        'Leanna',
        'Braylee',
        'Kiana',
        'Wrenley',
        'Barbara',
        'Khalani',
        'Aspyn',
        'Ellison',
        'Judith',
        'Robin',
        'Valery',
        'Aila',
        'Deborah',
        'Cara',
        'Clarissa',
        'Iyla',
        'Lexie',
        'Anais',
        'Kaylie',
        'Nathalie',
        'Alisson',
        'Della',
        'Addilynn',
        'Elsa',
        'Zoya',
        'Layne',
        'Marlowe',
        'Jovie',
        'Kenia',
        'Samira',
        'Jaylee',
        'Jenesis',
        'Etta',
        'Shay',
        'Amayah',
        'Avayah',
        'Egypt',
        'Flora',
        'Raquel',
        'Whitney',
        'Zola',
        'Giavanna',
        'Raya',
        'Veda',
        'Halo',
        'Paloma',
        'Nataly',
        'Whitley',
        'Dalary',
        'Drew',
        'Guadalupe',
        'Kamari',
        'Esperanza',
        'Loretta',
        'Malayah',
        'Natasha',
        'Stormi',
        'Ansley',
        'Carolyn',
        'Corinne',
        'Paola',
        'Brittany',
        'Emerald',
        'Freyja',
        'Zainab',
        'Artemis',
        'Jillian',
        'Kimora',
        'Zoie',
        'Aislinn',
        'Emmaline',
        'Ayleen',
        'Queen',
        'Jaycee',
        'Murphy',
        'Nyomi',
        'Elina',
        'Hadleigh',
        'Marceline',
        'Marisol',
        'Yasmin',
        'Zendaya',
        'Chandler',
        'Emani',
        'Jaelynn',
        'Kaiya',
        'Nathalia',
        'Violette',
        'Joyce',
        'Paityn',
        'Elisabeth',
        'Emmalynn',
        'Luella',
        'Yamileth',
        'Aarya',
        'Luisa',
        'Zhuri',
        'Araceli',
        'Harleigh',
        'Madalynn',
        'Melani',
        'Laylani',
        'Magdalena',
        'Mazikeen',
        'Belle',
        'Kadence',
    ];

    public function down(Schema $schema): void
    {
        $this->addSql(
            'DELETE FROM user WHERE TRUE;'
        );
    }

    public function getDescription(): string
    {
        return 'Add 1m users';
    }

    public function up(Schema $schema): void
    {
        $numberOfNames = count($this->names);
        $numberOfSurnames = count($this->surnames);

        for ($i = 0; $i <= 1000000; $i++) {
            $id = Uuid::uuid4()->toString();
            $sql = 'INSERT INTO user ' .
                '(id, name, surname, login, roles, password, interests, age, sex) ' .
                sprintf(
                    "VALUES ('%s', '%s', '%s', '%s', '[\"ROLE_USER\"]', '%s', 'reading', %d, 'f');",
                    $id,
                    $this->names[random_int(0, $numberOfNames - 1)],
                    $this->surnames[random_int(0, $numberOfSurnames - 1)],
                    'login' . $i,
                    '$2y$13$dE494xMtnj83fXx1LN.P7.cSHamyHG8HIKwpLV7Q5GUM4a9wz6D7y',
                    random_int(16, 35)
                );

            $this->addSql($sql);
        }
    }
}
