module.exports = (sequelize, DataTypes) => {
    const TeenpattiTableMaster = sequelize.define("tbl_table_master", {
        id: {
            type: DataTypes.INTEGER,
            primaryKey: true,
            autoIncrement: true
        },
        boot_value: {
            type: DataTypes.BIGINT,
        },
        maximum_blind: {
            type: DataTypes.INTEGER,
        },
        chaal_limit: {
            type: DataTypes.BIGINT,
        },
        pot_limit: {
            type: DataTypes.BIGINT,
        },
        added_date: {
            type: DataTypes.DATE,
            allowNull: false,
            defaultValue: DataTypes.NOW
        },
        updated_date: {
            type: DataTypes.DATE,
            allowNull: false,
            defaultValue: DataTypes.NOW
        },
        isDeleted: {
            type: DataTypes.TINYINT,
            allowNull: false,
            defaultValue: 0
        }
    }, {
        tableName: 'tbl_table_master',
        timestamps: true,
        createdAt: 'added_date',
        updatedAt: 'updated_date',
        defaultScope: {
            where: {
                isDeleted: 0
            }
        },
        scopes: {
            withDeleted: {
                where: {}
            }
        },
        indexes: [
            {
                name: 'idx_isDeleted',
                fields: ['isDeleted']
            }
        ]
    });

    TeenpattiTableMaster.associate = (models) => {
        TeenpattiTableMaster.hasMany(models.TeenpattiTable, { foreignKey: 'boot_value', sourceKey: 'boot_value' });
    };

    return TeenpattiTableMaster;
}