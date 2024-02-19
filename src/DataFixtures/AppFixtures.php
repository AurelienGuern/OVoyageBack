<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tag;
use App\Entity\City;
use App\Entity\Item;
use App\Entity\Trip;
use App\Entity\User;
use App\Entity\Vote;
use App\Entity\Friend;
use App\Entity\Country;
use App\Entity\Activity;
use Faker\Factory as Faker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $cities = [];
    private $countries = [];
    private $trips = [];
    private User $admin;
    private $users = [];
    private $activities = [];
    private $tags = [];
    private $items = [];

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {

        echo "\n";
        echo "Création de fausses données. Merci de patienter.\n";
        echo "\n";

        $baseURL = explode("html/", __DIR__);
        $baseURL2 = explode("/src/", $baseURL[1]);
        $baseURL = $baseURL2[0];

        echo "Création de l'admin...\n";

        $userData = [
            "email" => "admin@admin.com",
            "password" => "admin",
            "roles" => ['ROLE_ADMIN'],
            "firstname" => "Monsieur",
            "lastname" => "l'Admin",
        ];

        $user = new User;
        $user->setEmail($userData["email"]);
        $user->setFirstname($userData["firstname"]);
        $user->setLastname($userData["lastname"]);
        $user->setRoles($userData["roles"]);
        $user->setPassword($this->passwordHasher->hashPassword($user, $userData["password"]));
        $user->setCreatedAt(new \DateTimeImmutable());
        
        $user->setAvatar("avatar" . rand(1, 4) . ".jpg");
        $manager->persist($user);

        $user->setAvatarURL("http://localhost/" . $baseURL . "/public/uploads/images/" . $user->getAvatar());
        $manager->persist($user);

        $this->admin = $user;

        $manager->flush();

        echo "Création de l'admin OK\n";
        echo "\n";

        echo "Création d'utilisateurs...\n";

        for ($i = 0; $i < 15; $i++) {

            $faker = Factory::create('fr_FR');

            $user = new User;
            $user->setEmail($faker->unique()->email());
            $user->setPassword($this->passwordHasher->hashPassword($user, $faker->password()));
            $user->setLastname($faker->lastName());
            $user->setFirstname($faker->firstName());
            $user->setRoles(["ROLE_USER"]);
            $user->setCreatedAt(new \DateTimeImmutable());

            $user->setAvatar("avatar" . rand(1, 4) . ".jpg");
            $manager->persist($user);

            $user->setAvatarURL("http://localhost/" . $baseURL . "/public/uploads/images/" . $user->getAvatar());
            $manager->persist($user);

            $this->users[] = $user;

            $friends = new Friend;
            $friends->setUser1($this->admin);
            $friends->setUser2($user);
            $friends->setRelationship(true);
            $friends->setCreatedBy(true);

            $manager->persist($friends);
        }

        echo "Création d'utilisateurs OK\n";
        echo "\n";

        $manager->flush();

        echo "Création des pays...\n";

        for ($i = 0; $i < 30; $i++) {

            $faker = Factory::create('fr_FR');

            $country = new Country;
            $country->setName($faker->unique()->country());
            $country->setCountryPicture("country" . rand(1, 4) . ".jpg");
            $manager->persist($country);

            $country->setCountryPictureURL("http://localhost/" . $baseURL . "/public/uploads/images/" . $country->getCountryPicture());
            $manager->persist($country);

            $this->countries[] = $country;
        }

        echo "Création des pays OK\n";
        echo "\n";

        $manager->flush();

        echo "Création des villes...\n";

        foreach($this->countries as $actualCountry)
        {
            for ($i = 0; $i < 5; $i++) {
                $faker = Factory::create('fr_FR');

                $city = new City;
                $city->setName($faker->unique()->city());
                $city->setCountry($actualCountry);

                $manager->persist($city);
                $this->cities[] = $city;
            }
        }

        echo "Création des villes OK\n";
        echo "\n";

        $manager->flush();

        echo "Création de voyages...\n";

        for ($i = 0; $i < 20; $i++) {
            $faker = Factory::create('fr_FR');

            $trip = new Trip;
            $trip->setName($faker->country());
            $trip->setDescription($faker->sentence(15));

            if($i === 10)
            {
                $debutDate = $faker->dateTimeInInterval("-3 days", "now");
                $endDate = $faker->dateTimeInInterval("+3 days", "+1 week");

                $trip->setStartDate(\DateTimeImmutable::createFromMutable($debutDate));
                $trip->setEndDate(\DateTimeImmutable::createFromMutable($endDate));
            }
            if($i < 10)
            {
                $debutDate = $faker->dateTimeInInterval('-1 years', '-1 month');
                $endDate = $faker->dateTimeInInterval($debutDate, "+1 months");

                $trip->setStartDate(\DateTimeImmutable::createFromMutable($debutDate));
                $trip->setEndDate(\DateTimeImmutable::createFromMutable($endDate));
            }
            if($i > 10)
            {
                $debutDate = $faker->dateTimeInInterval('+1 month', '+1 years');
                $endDate = $faker->dateTimeInInterval($debutDate, "+1 months");

                $trip->setStartDate(\DateTimeImmutable::createFromMutable($debutDate));
                $trip->setEndDate(\DateTimeImmutable::createFromMutable($endDate));
            }

            for ($j = 0; $j < rand(1, 4); $j++) {
                $trip->addCity($this->cities[rand(0, 9)]);
            }

            $trip->setAdmin($this->admin);
            $trip->addTraveler($this->admin);
            $trip->addTraveler($this->users[rand(0, 4)]);
            $trip->addTraveler($this->users[rand(5, 9)]);
            $trip->addTraveler($this->users[rand(10, 14)]);
            $trip->setCreatedAt(new \DateTimeImmutable());

            $trip->setBackgroundPicture("background" . rand(1, 4) . ".jpg");
            $manager->persist($trip);

            $trip->setBackgroundPictureURL("http://localhost/" . $baseURL . "/public/uploads/images/" . $trip->getBackgroundPicture());
            $manager->persist($trip);

            $manager->persist($trip);

            $this->trips[] = $trip;
        }

        $manager->flush();

        echo "Création de voyages OK\n";
        echo "\n";

        echo "Création de tags...\n";

        $tagsToInput = [
            "Restaurant",
            "Bar",
            "Activité Culturelle",
            "Balade"
        ];

        for ($i = 0; $i < 4; $i++) {
            $tag = new Tag;
            $tag->setName($tagsToInput[$i]);

            $manager->persist($tag);

            $this->tags[] = $tag;
        }

        $manager->flush();

        echo "Création de tags OK\n";
        echo "\n";

        echo "Création d'items...\n";

        $itemsToInput = [
            "Passeport",
            "CNI",
            "Eau",
            "Peigne",
            "Bouée canard"
        ];

        foreach($this->trips as $actualTrip)
        {
            $allUserTrips = $actualTrip->getTravelers();

            foreach($allUserTrips as $actualUser)
            {
                for ($j = 0; $j < 5; $j++) {
                    $item = new Item;
                    $item->setName($itemsToInput[$j]);
                    $item->setChecked(false);
                    $item->setUser($actualUser);
                    $item->setTrip($actualTrip);
        
                    $manager->persist($item);
                }
            }
        }

        $manager->flush();

        echo "Création d'item OK\n";
        echo "\n";

        echo "Création d'activités...\n";

        foreach($this->trips as $actualTrip)
        {
            for ($i = 0; $i < 6; $i++) {

                $faker = Factory::create('fr_FR');
    
                $activity = new Activity;
                $activity->setName($faker->unique()->company());
                $activity->setDate(new \DateTimeImmutable());
    
                $activity->setPostalAddress($faker->streetAddress() . ",  " . $faker->city());
                $activity->setPrice(rand(1, 40));
                $activity->setOpeningTimeAndDays($faker->paragraph());
                $activity->setScore(rand(0, 20));
                $activity->setCreator($this->users[rand(0, 10)]);
    
                $activity->setTrip($actualTrip);
    
                $debutDateTrip = $actualTrip->getStartDate();
                $endDateTrip = $actualTrip->getEndDate();
    
                $activity->setDate(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween($debutDateTrip->format("Y-m-d"), $endDateTrip->format("Y-m-d"))));
    
                $activity->addTag($this->tags[rand(0, 3)]);
    
                $manager->persist($activity);
    
                $citiesOfTheTrip = $activity->getTrip()->getCities();
                $activity->setCity($citiesOfTheTrip[rand(0, (count($citiesOfTheTrip) - 1))]);
    
                $manager->persist($activity);
    
                $this->activities[] = $activity;
            }
        }

        $manager->flush();

        echo "Création d'activités OK\n";
        echo "\n";

        echo "Création de votes sur les activités...";
        echo "\n";

        foreach($this->activities as $actualActivity)
        {

            $getAllUser = $actualActivity->getTrip()->getTravelers();

            foreach($getAllUser as $actualUserVote)
            {
                $faker = Factory::create('fr_FR');
                {
                    if($faker->boolean())
                    {
                        $vote = new Vote;
                        $vote->setUser($actualUserVote);
                        $vote->setActivity($actualActivity);
                        $vote->setRating(rand(1, 3));
                        $manager->persist($vote);
                    }
                }
            }
        }

        $manager->flush();

        echo "Création de votes OK";
        echo "\n";
        echo "\n";

        echo "Création des fausses données terminée !";
        echo "\n";
    }
}
