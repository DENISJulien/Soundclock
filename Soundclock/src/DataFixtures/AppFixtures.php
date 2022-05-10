<?php

namespace App\DataFixtures;

use App\Entity\Banner;
use App\Entity\Genre;
use App\Entity\Music;
use App\Entity\Playlist;
use App\Entity\Review;
use App\Entity\User;
use App\Service\MySlugger;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory as Faker;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{

    private $connexion;
    private $hasher;
    private $mySlugger;
    
    public function __construct(Connection $connexion, UserPasswordHasherInterface $hasher, MySlugger $mySlugger)
    {
        $this->connexion = $connexion;
        $this->hasher = $hasher;
        $this->mySlugger = $mySlugger;
    }


    private function truncate()
    {
        $this->connexion->executeQuery('SET foreign_key_checks = 0');

        $this->connexion->executeQuery('TRUNCATE TABLE banner');
        $this->connexion->executeQuery('TRUNCATE TABLE genre');
        $this->connexion->executeQuery('TRUNCATE TABLE music');
        $this->connexion->executeQuery('TRUNCATE TABLE music_genre');
        $this->connexion->executeQuery('TRUNCATE TABLE music_playlist');
        $this->connexion->executeQuery('TRUNCATE TABLE playlist');
        $this->connexion->executeQuery('TRUNCATE TABLE review');
        $this->connexion->executeQuery('TRUNCATE TABLE user');
        $this->connexion->executeQuery('TRUNCATE TABLE music_user');
    }

    public function load(ObjectManager $manager): void
    {

        $this->truncate();

        $faker = Faker::create('fr_FR');


        /************* Genre *************/

        // Making of data fixtures for Genre Entity :
        $allGenreEntity = [];
        $genreNames = [
            'Pop', 'Rock', 'Hip-Hop', 'RNB', 'Electro', 'Dance', 'Soul', 'Funk', 'Classique', 'Jazz', 'Ambient', 'Expérimentale'
        ];
        
        foreach ($genreNames as $genreName) {

            $newGenre = new Genre();
            $newGenre->setNameGenre($genreName);

            $newGenre->setPictureGenre('https://picsum.photos/id/'.mt_rand(1, 100).'/303/424');
            $newGenre->setDescriptionGenre($faker->realText($maxNbChars = 50, $indexSize = 2));
            $newGenre->setStatusGenre(1);
            $genreSlug = $this->mySlugger->slugify($newGenre->getNameGenre());
            $newGenre->setSlugGenre($genreSlug);

            $newGenre->setCreatedAtGenre(new DateTimeImmutable('now'));

            $allGenreEntity[] = $newGenre;

            $manager->persist($newGenre);
        } 


        /************* User *************/

        $users = [
            [
                'name' => 'Julien',
                'email' => 'julien@julien.com',
                'password' => 'julien',
                'certification' => true,
                'roles' => 'ROLE_ADMIN',
                'status' => 1,         
            ],
            [
                'name' => 'Guillaume',
                'email' => 'guillaume@guillaume.com',
                'password' => 'guillaume',
                'certification' => true,
                'roles' => 'ROLE_ADMIN',
                'status' => 1,
            ],
            [
                'name' => 'Jean-Baptiste',
                'email' => 'jb@jb.com',
                'password' => 'jb',
                'certification' => true,
                'roles' => 'ROLE_ADMIN',
                'status' => 1,
            ],
            [
                'name' => 'Raphaël',
                'email' => 'raphael@raphael.com',
                'password' => 'raphael',
                'certification' => true,
                'roles' => 'ROLE_ADMIN',
                'status' => 1,
            ],
            [
                'name' => 'Nico',
                'email' => 'nico@nico.com',
                'password' => 'nico',
                'certification' => true,
                'roles' => 'ROLE_ADMIN',
                'status' => 1,
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@bob.com',
                'password' => 'bob',
                'certification' => false,
                'roles' => 'ROLE_USER',
                'status' => 1,
            ]
        ];

        $allUserEntity = [];

        foreach ($users as $currentUser)
        {

            $newUser = new User();
            $newUser->setNameUser($currentUser['name']);
            $newUser->setEmail($currentUser['email']);

            $hashedPassword = $this->hasher->hashPassword(
                $newUser,
                $currentUser['password']
            );
            $newUser->setPassword($hashedPassword);
            $newUser->setPictureUser('https://picsum.photos/id/'.mt_rand(1, 100).'/303/424');
            $newUser->setDescriptionUser($faker->realText($maxNbChars = 50, $indexSize = 2));
            $newUser->setCertificationUser($currentUser['certification']);
            $newUser->setRoles([$currentUser['roles']]);
            $newUser->setStatusUser($currentUser['status']);
            $newUser->setLabelUser($faker->lastName());
            $newUser->setCreatedAtUser(new DateTimeImmutable('now'));

            $allUserEntity[] =$newUser;

            $manager->persist($newUser);
        }

        /************* Music *************/

        $allMusicEntity = [];
        $musicFiles = [
            'https://www.youtube.com/watch?v=7yh9i0PAjck', 'https://www.youtube.com/watch?v=U2wtIIT9hMU', 'https://www.youtube.com/watch?v=IRvGZffXhfk', 'https://www.youtube.com/watch?v=YnopHCL1Jk8', 'https://www.youtube.com/watch?v=U6n2NcJ7rLc', 'https://www.youtube.com/watch?v=bpEmjxobvbY'
        ];


        for ($i = 1; $i<= 20; $i++)
        {
            $newMusic = new Music();
            $newMusic->setNameMusic($faker->sentence(rand(1,4)));
            $newMusic->setFileMusic($musicFiles[mt_rand(0, count($musicFiles) - 1)]);
            $newMusic->setPictureMusic('https://picsum.photos/id/'.mt_rand(1, 100).'/303/424');
            $newMusic->setDescriptionMusic($faker->realText($maxNbChars = 25, $indexSize = 2));
            $newMusic->setStatusMusic(1);
            // $newMusic->setReleasedateMusic(new DateTimeImmutable (rand(1,28) . '/' . rand(1,12) . '/' . rand(1950,2022)));
            $newMusic->setReleasedateMusic($faker->dateTimeBetween('-20years', 'now'));
            $newMusic->setNblikeMusic(rand(1,1000));
            $newMusic->setNblistenedMusic(rand(1,1000000));
            // $musicSlug = $this->mySlugger->slugify($newMusic->getTitle());
            // $newMusic->setSlug($musicSlug);
    
            $newMusic->setCreatedAtMusic(new DateTimeImmutable('now'));
    
            for ($j = 1; $j<= rand(1, rand(1,2)); $j++) 
            {
                $randomUser = $allUserEntity[mt_rand(0, count($allUserEntity) - 1)];
                $newMusic->addUser($randomUser);
            }

            for ($j = 1; $j<= rand(1, 3); $j++) 
            {
                $randomGenre = $allGenreEntity[mt_rand(0, count($allGenreEntity) - 1)];
                $newMusic->addGenre($randomGenre);
            }
    
            $allMusicEntity[] = $newMusic;

            $manager->persist($newMusic);
        }


        /************* Playlist*************/

        $allPlaylistEntity = [];

        for ($i = 1; $i<= 20; $i++)
        {
            $newPlaylist = new Playlist();
            
            $newPlaylist->setNamePlaylist($faker->word());
            $newPlaylist->setPicturePlaylist('https://picsum.photos/id/'.mt_rand(1, 100).'/303/424');
            $newPlaylist->setDescriptionPlaylist($faker->realText($maxNbChars = 50, $indexSize = 2));
            $newPlaylist->setAlbum(rand(0,1));
            $newPlaylist->setStatusPlaylist(1);
            $newPlaylist->setNblikePlaylist(rand(1,1000));

            $playlistSlug = $this->mySlugger->slugify($newPlaylist->getNamePlaylist());
            $newPlaylist->setSlugPlaylist($playlistSlug);

            $newPlaylist->setCreatedAtPlaylist(new DateTimeImmutable('now'));


            $randomUser = $allUserEntity[mt_rand(0, count($allUserEntity) - 1)];
            $newPlaylist->setUser($randomUser);
            
            for ($j = 1; $j<= rand(1, 40); $j++) 
            {
                $randomMusic = $allMusicEntity[mt_rand(0, count($allMusicEntity) - 1)];
                $newPlaylist->addMusic($randomMusic);
            }

            $allPlaylistEntity[] = $newPlaylist;

            $manager->persist($newPlaylist);            
        }


        /************* Review *************/

        $allReviewEntity = [];      

        for ($i = 1; $i<= 20; $i++) 
        {
            
            $newReview = new Review();
            $newReview->setNameReview($faker->word());
            $newReview->setContentReview($faker->realText($maxNbChars = 100, $indexSize = 2));
            $newReview->setStatusReview(1);
            $newReview->setCreatedAtReview(new DateTimeImmutable('now'));

            $randomUser = $allUserEntity[mt_rand(0, count($allUserEntity) - 1)];
            $newReview->setUser($randomUser);


            $randomMusic = $allMusicEntity[mt_rand(0, count($allMusicEntity) - 1)];
            $newReview->setMusic($randomMusic);

            $allReviewEntity[] = $newReview;

            $manager->persist($newReview);
        }


        /************* Banner *************/ 

        for ($i = 1; $i<= 5; $i++) 
        {
            
            $newBanner = new Banner();
            $newBanner->setNameBanner('https://picsum.photos/id/'.mt_rand(3, 300).'/303/424');
            $newBanner->setStatusBanner(1);
            $newBanner->setCreatedAtBanner(new DateTimeImmutable('now'));
            $manager->persist($newBanner);
        }
    
        $manager->flush();
    }
}
