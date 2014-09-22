<?php

/*
 * This file is part of the Aisel package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Aisel\FixtureBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Aisel\FixtureBundle\DataFixtures\XMLFixtureData;

/**
 * Backend users fixtures
 *
 * @author Ivan Proskoryakov <volgodark@gmail.com>
 */
class LoadBackendUserData extends XMLFixtureData implements OrderedFixtureInterface
{
    protected $fixturesName = 'aisel_user_backend.xml';

    /**
     * Backend user manager
     * @return \Aisel\BackendUserBundle\Manager\UserManager
     */
    protected function getUserManager()
    {
        return $this->container->get('backend.user.manager');
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        if (file_exists($this->fixturesFile)) {
            $contents = file_get_contents($this->fixturesFile);
            $XML = simplexml_load_string($contents);

            foreach ($XML->database->table as $table) {
                $userData = array(
                    'username' => (string) $table->column[1],
                    'email' => (string) $table->column[2],
                    'password' => (string) $table->column[3],
                );
                $this->getUserManager()->registerFixturesUser($userData);

            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 110;
    }
}