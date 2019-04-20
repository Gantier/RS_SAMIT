<?php

    class Constants
    {
        const ADMIN = "Admin";
        const RESEARCHER = "Researcher";
        const STUDENT = "Student";
        const FACULTY = "Faculty";
        const COURSE = "Course";
        const SECTION = "Section";
        const REGISTRATION = "Registration";
        const UNDERGRADUATE = "Undergraduate";
        const GRADUATE = "Graduate";
        const COURSE_CATALOG = "Course Catalog";
        const MASTER_SCHEDULE = "Master Schedule";

        const SUBJECTS = array('Business',
                               'Chemistry and Physics',
                               'Computer Sciences',
                               'History and Philosophy',
                               'Mathematics',
                               'Psychology',
                               'Visual Arts');
        const ATTRIBUTES = array('Liberal Arts',
                                 'Natural Sciences',
                                 'Computer Science',
                                 'Western Traditions',
                                 'Major Cultures',
                                 'Mathematics',
                                 'Social Science Designation',
                                 'Creativity and the Arts');

        const MESSAGE_SUBS = array('SR_SUCCESS' => 'Registration Successful',
                                   'SR_FAIL' => 'Registration Failure',
                                   'EP_SUCCESS' => 'Password Changed',
                                   'EP_FAIL' => 'Password Unchanged');

        const MESSAGE_BODS = array('SR_SUCCESS' => 'You were successfully registered for a new course: ',
                                   'SR_FAIL' => 'You were unable to register for a new course: ',
                                   'EP_SUCCESS' => 'Your account password was successfully edited.',
                                   'EP_FAIL' => 'New password must be at least 8 characters and must contain at least ' .
                                       'one lower case letter, one upper case letter, and one digit.');

        const DEFAULT_COURSE_HELPER = "'Showing all courses...'";
        const ACTIVE_SEARCH_COURSE_HELPER = "'Showing all courses containing: \''";
        const DEFAULT_SECTION_HELPER = "'Showing all sections...'";
        const ACTIVE_SEARCH_SECTION_HELPER = "'Showing all sections containing: \''";
    }
