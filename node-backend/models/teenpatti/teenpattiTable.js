module.exports = (sequelize, DataTypes) => {
    const TeenpattiTable = sequelize.define("tbl_table", {
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
        private: {
            type: DataTypes.TINYINT
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
        tableName: 'tbl_table',
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

    TeenpattiTable.associate = (models) => {
        TeenpattiTable.belongsTo(models.TeenpattiTableMaster, {
            foreignKey: 'boot_value',
            targetKey: 'boot_value'
        });

        TeenpattiTable.hasMany(models.user, { foreignKey: 'table_id', sourceKey: 'id', as: 'users' });
    };

    return TeenpattiTable;
}