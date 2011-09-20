#Crude CRUD generator

Crude is a GUI CRUD generator in wizard form. Unlike Oil, it is limited to using existing tables.
Generated files are available via a zip file download.

NOTE! Crude is for development environments only.

# Install

 * Copy the 'crude' directory to your APPPATH/modules directory
 * Copy COREPATH/config/session.php to APPPATH/config/session.php and change the 'driver' key to 'file'. Crude requires the file session driver.
 * APPPATH/config/config.php - Enable the default module_paths
 * APPPATH/config/config.php - Enable orm in always_load.packages
 * APPPATH/config/db.php     - Configure your database

# Usage

Depending on your setup, go to...
`http://yourhost/index.php/crude`
or
`http://yourhost/crude`

and follow the on-screen instructions.

# Configuration

to come...
